<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use App\Models\RecipeComment;
use App\Models\RecipeImage;
use App\Models\RecipeLike;
use App\Models\RecipeShare;
use App\Models\RecipeView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class RecipeController extends Controller
{
    public function homePagerecipes()
    {
        $recipes = Recipe::withCount(['likes', 'comments', 'views', 'images'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('Frontend.recipes.index', compact('recipes'));
    }

    public function homePagerecipesDetail(Recipe $recipe)
    {
        RecipeView::create([
            'recipe_id' => $recipe->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);
        
        return view('Frontend.recipes.show', [
            'recipe' => $recipe,
            'shareLinks' => $this->generateShareLinks($recipe),
            'likeCount' => $recipe->likes()->count(),
            'isLiked' => $recipe->likes()->where('user_id', auth()->id())->exists(),
            'comments' => $recipe->comments()->with('user')->get(),
            'commentCount' => $recipe->comments()->count(),
            'viewCount' => $recipe->views()->count()
        ]);
    }

    public function index()
    {
        $recipes = Recipe::withCount(['likes', 'comments', 'views', 'images'])
                    ->orderBy('created_at', 'desc')
                    ->get();
        
        return view('pages.recipe.index', compact('recipes'));
    }

    public function create()
    {
        $categories  = Category::all();
        return view('pages.recipe.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'desc' => 'required',
            'desc2' => 'required',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:20000',
            'publish_at' => 'required|date',
            'status' => 'required|in:public,private,draft',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id'
        ]);

       $recipe = Recipe::create($request->except('images', 'categories'));

        if ($request->has('categories')) {
            $recipe->categories()->attach($request->categories);
        }
        // Handle multiple image uploads
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('recipe_images', 'public');
                // Save to your images table if you have one
                RecipeImage::create([
                    'recipe_id' =>$recipe->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('recipes.index')->with('success', 'Recipe created successfully.');
    }

    public function show(Recipe $recipe)
    {
        // Record view
        RecipeView::create([
            'recipe_id' =>$recipe->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        return view('pages.recipe.show',[
            'recipe' =>$recipe,
            // 'shareLinks' => $shareLinks,
            'shareLinks' => $this->generateShareLinks($recipe),
            'likeCount' =>$recipe->likes()->count(), // Now this will work
            'isLiked' =>$recipe->likes()->where('user_id', auth()->id())->exists(),
            'comments' =>$recipe->comments()->with('user')->get(),
            'viewCount' =>$recipe->views()->count()
        ]);
    }

    private function generateShareLinks($recipe)
    {
        $url = urlencode(route('recipes.show', $recipe));
        $title = urlencode($recipe->name);
        
        return [
            'facebook' => "https://www.facebook.com/sharer/sharer.php?u={$url}",
            'twitter' => "https://twitter.com/intent/tweet?text={$title}&url={$url}",
            'linkedin' => "https://www.linkedin.com/shareArticle?mini=true&url={$url}&title={$title}",
            'copy_link' => route('recipes.show', $recipe),
        ];
    }

    // Update the share method to use the internal generator
    public function share(Request $request, Recipe $recipe)
    {
        $request->validate([
            'platform' => 'required|in:facebook,twitter,linkedin,copy_link'
        ]);

        RecipeShare::create([
            'reciepe_id' =>$recipe->id,
            'user_id' => Auth::id(),
            'platform' => $request->platform,
            'ip_address' => request()->ip()
        ]);

        $shareLinks = $this->generateShareLinks($recipe);
        
        if ($request->platform !== 'copy_link') {
            return redirect($shareLinks[$request->platform]);
        }

        return back()->with('success', 'Link copied to clipboard!');
    }

    public function edit(Recipe $recipe)
    {
        $categories  = Category::all();
        return view('pages.recipe.edit', compact('recipe', 'categories'));
    }

    public function update(Request $request, Recipe $recipe)
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
        'removed_images.*' => 'exists:recipe_images,id'
    ]);

    // Update recipe data (excluding special fields)
    $recipe->update($request->only(['name', 'desc', 'desc2', 'publish_at', 'status']));

    // Handle removed images
    if ($request->filled('removed_images')) {
        $imagesToDelete = RecipeImage::where('recipe_id', $recipe->id)
                                    ->whereIn('id', $request->removed_images)
                                    ->get();

        foreach ($imagesToDelete as $image) {
            try {
                Storage::disk('public')->delete($image->path);
                $image->delete();
            } catch (\Exception $e) {
                Log::error("Failed to delete recipe image: ".$e->getMessage());
            }
        }
    }

    // Handle new image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            try {
                $path = $image->store('recipe_images', 'public');
                RecipeImage::create([
                    'recipe_id' => $recipe->id,
                    'path' => $path
                ]);
            } catch (\Exception $e) {
                Log::error("Failed to upload recipe image: ".$e->getMessage());
            }
        }
    }

    // Sync categories
    if ($request->has('categories')) {
        $recipe->categories()->sync($request->categories);
    } else {
        $recipe->categories()->detach();
    }

    return redirect()->back()
                    ->with('success', 'Recipe updated successfully.');
}

    public function destroy(Recipe $recipe)
    {
        // Delete associated image if exists
        if ($recipe->image) {
            Storage::disk('public')->delete($recipe->image);
        }
        
       $recipe->delete();
        return redirect()->route('recipes.index')->with('success', 'Recipe deleted successfully.');
    }

    public function like(Recipe $recipe)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login to like this blog.');
        }
        $like = $recipe->likes()->where('user_id', Auth::id())->first();
        
        if ($like) {
            $like->delete();
            $message = 'Blog unliked successfully.';
        } else {
            RecipeLike::create([
                'recipe_id' => $recipe->id,
                'user_id' => Auth::id()
            ]);
            $message = 'Recipe liked successfully.';
        }

        return back()->with('success', $message);
    }

    public function comment(Request $request, Recipe $recipe)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You need to login to comment.');
        }
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:recipe_comments,id'
        ]);

        RecipeComment::create([
            'recipe_id' =>$recipe->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id
        ]);

        return back()->with('success', 'Comment added successfully.');
    }
}
