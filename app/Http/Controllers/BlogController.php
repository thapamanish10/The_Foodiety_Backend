<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\BlogLike;
use App\Models\BlogComment;
use App\Models\BlogView;
use App\Models\BlogShare;
use App\Models\BlogImage;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function homePageBlogs(Request $request)
    {
        $query = Blog::withCount(['likes', 'comments', 'views', 'images'])
                    ->with(['categories'])
                    ->orderBy('created_at', 'desc');

        if ($request->has('categories')) {
            $query->whereHas('categories', function($q) use ($request) {
                $q->whereIn('slug', $request->categories);
            });
        }
        
        $blogs = $query->paginate(7); // Changed from $items to $blogs
        $categories = Category::all(); 
        
        return view('Frontend.blogs.index', compact('blogs', 'categories'));
    }

    public function homePageBlogsDetail(Blog $blog)
    {
        // Track view
        BlogView::create([
            'blog_id' => $blog->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        return view('Frontend.blogs.show', [
            'blog' => $blog,
            'shareLinks' => $this->generateShareLinks($blog) ?? [],
            'likeCount' => $blog->likes()->count(),
            'isLiked' => $blog->likes()->where('user_id', auth()->id())->exists(),
            'comments' => $blog->comments()->with('user')->get(),
            'commentCount' => $blog->comments()->count(),
            'viewCount' => $blog->views()->count()
        ]);
    }
    public function index()
    {
        $blogs = Blog::withCount(['likes', 'comments', 'views', 'images'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(7);
        
        return view('pages.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.blog.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required',
            'desc2' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:102400',
            'publish_at' => 'required|date',
            'status' => 'required|in:public,private,draft',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

        $blog = Blog::create($request->except(['images', 'categories']));

        if ($request->has('categories')) {
            $blog->categories()->attach($request->categories);
        }
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('blog_images', 'public');
                // Save to your images table if you have one
                BlogImage::create([
                    'blog_id' => $blog->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully.');
    }

    public function show(Blog $blog)
    {
        // Record view
        BlogView::create([
            'blog_id' => $blog->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        $shareLinks = [
            'facebook' => 'https://www.facebook.com/sharer/sharer.php?u='.urlencode(route('blogs.show', $blog)),
            'twitter' => 'https://twitter.com/intent/tweet?text='.urlencode($blog->name).'&url='.urlencode(route('blogs.show', $blog)),
            'linkedin' => 'https://www.linkedin.com/shareArticle?mini=true&url='.urlencode(route('blogs.show', $blog)).'&title='.urlencode($blog->name),
            'copy_link' => route('blogs.show', $blog)
        ];

        return view('pages.blog.show',[
            'blog' => $blog,
            'shareLinks' => $shareLinks,
            'likeCount' => $blog->likes()->count(), // Now this will work
            'isLiked' => $blog->likes()->where('user_id', auth()->id())->exists(),
            'comments' => $blog->comments()->with('user')->get(),
            'viewCount' => $blog->views()->count()
        ]);
    }

    private function generateShareLinks($blog)
    {
        $baseUrl = config('app.url');
        $url = route('home.blogs.show', $blog);
        $encodedUrl = urlencode($url);
        
        // Prepare content
        $title = urlencode($blog->name);
        $description = urlencode(Str::limit(strip_tags($blog->desc), 100));
        
        // Get image URL
        $imageUrl = $blog->images->count() 
            ? url(Storage::url($blog->images->first()->path))
            : url('images/default-blog.jpg');
        $encodedImageUrl = urlencode($imageUrl);

        return [
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$encodedUrl}",
            'twitter' => "https://twitter.com/intent/tweet?text={$title}%0A%0A{$description}&url={$encodedUrl}",
            'whatsapp' => "https://wa.me/?text={$title}%0A%0A{$description}%0A%0A{$encodedUrl}",
            'copy_link' => $url,
            'image_url' => $imageUrl // For meta tags
        ];
    }

    // Update the share method to use the internal generator
    public function share(Request $request, Blog $blog)
    {
        $request->validate([
            'platform' => 'required|in:facebook,twitter,linkedin,copy_link'
        ]);

        BlogShare::create([
            'blog_id' => $blog->id,
            'user_id' => Auth::id(),
            'platform' => $request->platform,
            'ip_address' => request()->ip()
        ]);

        $shareLinks = $this->generateShareLinks($blog);
        
        if ($request->platform !== 'copy_link') {
            return redirect($shareLinks[$request->platform]);
        }

        return back()->with('success', 'Link copied to clipboard!');
    }

    public function edit(Blog $blog)
    {
        $categories = Category::all();
        return view('pages.blog.edit', compact('blog', 'categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required',
            'desc2' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20000',
            'publish_at' => 'required|date',
            'status' => 'required|in:public,private,draft',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
            'removed_images' => 'nullable|array',
            'removed_images.*' => 'exists:blog_images,id'
        ]);
    
        // Update blog data (excluding special fields)
        $blog->update($request->only(['name', 'desc', 'desc2', 'publish_at', 'status']));
    
        // Handle removed images
        if ($request->filled('removed_images')) {
            $imagesToDelete = BlogImage::where('blog_id', $blog->id)
                                        ->whereIn('id', $request->removed_images)
                                        ->get();
    
            foreach ($imagesToDelete as $image) {
                try {
                    Storage::disk('public')->delete($image->path);
                    $image->delete();
                } catch (\Exception $e) {
                    Log::error("Failed to delete blog image: ".$e->getMessage());
                }
            }
        }
    
        // Handle new image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                try {
                    $path = $image->store('blog_images', 'public');
                    BlogImage::create([
                        'blog_id' => $blog->id,
                        'path' => $path
                    ]);
                } catch (\Exception $e) {
                    Log::error("Failed to upload blog image: ".$e->getMessage());
                }
            }
        }
    
        // Sync categories
        if ($request->has('categories')) {
            $blog->categories()->sync($request->categories);
        } else {
            $blog->categories()->detach();
        }
    
        return redirect()->back()
                        ->with('success', 'blog updated successfully.');
    }

    public function deleteImage(BlogImage $image)
    {
        // Check if the authenticated user owns the blog that contains this image
        if (auth()->user()->id !== $image->blog->user_id) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        try {
            // Delete the file from storage
            Storage::delete('public/' . $image->path);
            
            // Delete the image record from database
            $image->delete();
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete image'], 500);
        }
    }
    public function destroy(Blog $blog)
    {
        // Delete associated image if exists
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        
        $blog->delete();
        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully.');
    }

    // Additional methods for engagement features
    public function like(Blog $blog)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('continue.with')->with('error', 'You need to login to like this blog.');
        }
    
        $like = $blog->likes()->where('user_id', Auth::id())->first();
        
        if ($like) {
            $like->delete();
            $message = 'Blog unliked successfully.';
        } else {
            BlogLike::create([
                'blog_id' => $blog->id,
                'user_id' => Auth::id()
            ]);
            $message = 'Blog liked successfully.';
        }
    
        return back()->with('success', $message);
    }
    
    public function comment(Request $request, Blog $blog)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('continue.with')->with('error', 'You need to login to comment.');
        }
    
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:blog_comments,id'
        ]);
    
        BlogComment::create([
            'blog_id' => $blog->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id
        ]);
    
        return back()->with('success', 'Comment added successfully.');
    }

}