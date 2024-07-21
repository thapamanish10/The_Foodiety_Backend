<?php

namespace App\Http\Controllers\blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\BlogImage;

class BlogController extends Controller
{
    //
    public function blogAPI()
    {
        try {
            $data = Blog::all();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching blog data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function blogImageAPI()
    {
        try {
            $data = BlogImage::all();
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching blog data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function blogSingelAPI($id)
    {
        try {
            $data = Blog::find($id);
            return response()->json($data, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching blog data',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    public function index()
    {
        $datas= Blog::paginate(10);
        $totalDatas = Blog::count();
        return view('pages.blog.blog',compact('datas', 'totalDatas'));
    }
    public function create()
    {
        return view('pages.blog.create.create');
    }
    public function detail($id)
    {
        $data = Blog::with(['images'])->findOrFail($id);
        return view('pages.blog.details.detail', compact('data'));
    }
    public function store(Request $request)
    {
         $request->validate([
            'blog_title' => 'required|string|max:255',
            'publish_date' => 'required|nullable|date',
            'blog_type' => 'required|string|max:20',
            'blog_text' => 'required|string',
        ]);

        $blog = new Blog();
        $blog->blog_title = $request->blog_title;
        $blog->publish_date = $request->publish_date;
        $blog->blog_type = $request->blog_type;
        $blog->blog_text = $request->blog_text;
        $blog->save();

        return redirect()->route('blog')->with('success', 'Blog added successfully.');
    }


    // BLOG EDIT
    public function edit($id)
    {
        $data = Blog::findOrFail($id);
        return view('pages.blog.edit.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'blog_title' => 'required|string|max:255',
            'publish_date' => 'nullable|date',
            'blog_type' => 'required|string|max:20',
            'blog_text' => 'required|string',
        ]);

        $blog = Blog::findOrFail($id);
        $blog->blog_title = $request->blog_title;
        $blog->publish_date = $request->publish_date;
        $blog->blog_type = $request->blog_type;
        $blog->blog_text = $request->blog_text;
        $blog->save();

        return redirect()->route('blog.detail', $blog->id)->with('success', 'Blog updated successfully.');
    }


    // BLOG DELETE
    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect()->route('blog')->with('success', 'Blog deleted successfully.');
    }

    // BLOG IMAGE
    public function createBlogImage($id)
    {
        $data = Blog::findOrFail($id);
        return view('pages.blog.images.create', compact('data'));
    }
    public function storeBlogImage(Request $request, $id)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,jpeg,png|max:5048',
            'image_name' => 'required|string',
            'image_type' => 'nullable|string|max:20',
        ]);

        $blog = new BlogImage();
        $blog->blog_id = $request->blog_id;
        $blog->image_name = $request->image_name;
        $blog->image_type = "landscape";

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('blogImage');
            $file->move($destinationPath, $filename);
            $blog->image = 'blogImage/' . $filename;
        }

        $blog->save();

        return redirect()->route('blog.detail', $blog->blog_id)->with('success', 'Blog image added successfully.');
    }

    public function manageBlogImage($id)
    {
        $data = Blog::with(['images'])->findOrFail($id);
        return view('pages.blog.manage.manage', compact('data'));
    }
    public function deleteBlogImage($id) {
        $data = BlogImage::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success', 'Image deleted successfully.');
    }
    public function editBlogImage($id)
    {
        $data = BlogImage::findOrFail($id); 
        $blog = $data->blog;
        return view('pages.blog.manage.edit.edit', compact('data', 'blog'));
    }
    public function updateBlogImage(Request $request, $id)
    {
        $image = BlogImage::findOrFail($id);
        $image->blog_id = $request->blog_id;
        $image->image_name = $request->image_name;
        $image->image_type = $request->image_type;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('resturentImage');
            $file->move($destinationPath, $filename);
            $image->image = 'resturentImage/' . $filename;
        }
        $image->save();

        return redirect()->route('blog.manage.image', $image->blog_id)->with('success', 'Image updated successfully.');
    }
}
