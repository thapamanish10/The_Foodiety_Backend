<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Recipe;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        $type = $request->input('type', 'blog');
        
        if (empty($query)) {
            return match($type) {
                'blog' => redirect()->route('home.blogs.index'),
                'recipe' => redirect()->route('home.recipes.index'),
                default => redirect()->back()
            };
        }
        
        $blogs = collect();
        $recipes = collect();
        
        switch ($type) {
            case 'blog':
                $blogs = Blog::where('name', 'like', "%{$query}%")
                        //    ->orWhere('desc', 'like', "%{$query}%")
                           ->with('images')
                           ->get();
                break;
                
            case 'recipe':
                $recipes = Recipe::where('name', 'like', "%{$query}%")
                            //    ->orWhere('desc', 'like', "%{$query}%")
                               ->with('images')
                               ->get();
                break;
                
            default:
                $blogs = Blog::where('name', 'like', "%{$query}%")
                        //    ->orWhere('desc', 'like', "%{$query}%")
                           ->with('images')
                           ->get();
                           
                $recipes = Recipe::where('name', 'like', "%{$query}%")
                            //    ->orWhere('desc', 'like', "%{$query}%")
                               ->with('images')
                               ->get();
        }
        
        return view('frontend.search.results', [
            'blogs' => $blogs,
            'recipes' => $recipes,
            'query' => $query,
            'searchType' => $type
        ]);
    }
}
