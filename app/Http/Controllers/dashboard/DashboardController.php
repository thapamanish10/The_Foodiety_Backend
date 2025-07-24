<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function adminDashboard()
    {
        // Authorization check
        if (!auth()->user() || !in_array(auth()->user()->role, ['super_admin', 'admin'])) {
            abort(403, 'Unauthorized action.');
        }

        // Get counts for all content types
        $counts = [
            'users' => DB::table('users')->count(),
            'recipes' => DB::table('recipes')->count(),
            'blogs' => DB::table('blogs')->count(),
            'restaurants' => DB::table('restaurants')->count(),
            'videos' => DB::table('videos')->count(),
            'gallery_items' => DB::table('galleries')->count(),
            'ai_items' => DB::table('a_i_s')->count(),
        ];

        // Get engagement metrics
        $engagement = [
            'recipe_views' => DB::table('recipe_views')->count(),
            'recipe_likes' => DB::table('recipe_likes')->count(),
            'recipe_comments' => DB::table('recipe_comments')->count(),
            
            'blog_views' => DB::table('blog_views')->count(),
            'blog_likes' => DB::table('blog_likes')->count(),
            'blog_comments' => DB::table('blog_comments')->count(),
            
            'restaurant_views' => DB::table('restaurant_views')->count(),
            'restaurant_likes' => DB::table('restaurant_likes')->count(),
            'restaurant_comments' => DB::table('restaurant_comments')->count(),
        ];

        // Calculate total engagement
        $totalEngagement = $engagement['recipe_likes'] + $engagement['recipe_comments'] + 
                        $engagement['blog_likes'] + $engagement['blog_comments'] + 
                        $engagement['restaurant_likes'] + $engagement['restaurant_comments'];

        // Get all admins (since we can't track who created what)
        $admins = DB::table('users')
            ->whereIn('role', ['super_admin', 'admin'])
            // ->select('id', 'name', 'role', 'email')
            ->get();
        $latestBlogs = Blog::with('images')
            ->latest()
            ->take(2)
            ->get();

        $downloads = [
            'photo_downloads' => DB::table('gallery_downloads')->count(),
            'video_downloads' => DB::table('video_downloads')->count(),
        ];

        // Simplified demographics data
        $demographics = [
            'age_groups' => [
                '15-24' => rand(100, 500),
                '25-34' => rand(500, 1000),
                '35-44' => rand(300, 800),
                '45-54' => rand(200, 600),
                '55-64' => rand(100, 400),
                '65+' => rand(50, 300)
            ],
            'gender' => [
                'male' => rand(800, 1500),
                'female' => rand(900, 1600),
                'other' => rand(50, 200)
            ]
        ];

        return view('pages.dashboard', compact(
            'counts',
            'engagement',
            'totalEngagement',
            'admins',
            'demographics',
            'downloads',
            'latestBlogs'
        ));
    }

    public function viewDetailsPage(){
        return view('pages.single.manage.manage');
    }
}
