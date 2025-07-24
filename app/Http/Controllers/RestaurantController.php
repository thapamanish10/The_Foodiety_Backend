<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Models\RestaurantComment;
use App\Models\RestaurantImage;
use App\Models\RestaurantLike;
use App\Models\RestaurantShare;
use App\Models\RestaurantView;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    public function welcomePageRestaurants()
    {
       $restaurants = Restaurant::with('images')->latest()->take(6)->get();
        
        return view('Frontend.restaurants.home-restaurant', compact('restaurants'));
    }
    public function homePageRestaurants()
    {
       $restaurants = Restaurant::with('images')->latest()->take(6)->get();
        
        return view('Frontend.restaurants.index', compact('restaurants'));
    }
    public function homePageRestaurantsDetail(Restaurant $restaurant)
    {
        RestaurantView::create([
            'restaurant_id' => $restaurant->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        return view('Frontend.restaurants.show',[
            'restaurant' => $restaurant,
            'shareLinks' => $this->generateShareLinks($restaurant) ?? [],
            'likeCount' => $restaurant->likes()->count(), // Now this will work
            'isLiked' => $restaurant->likes()->where('user_id', auth()->id())->exists(),
            'comments' => $restaurant->comments()->with('user')->get(),
            'commentCount' => $restaurant->comments()->count(),
            'viewCount' => $restaurant->views()->count()
        ]);
    }
    public function index()
    {
        $restaurants = Restaurant::latest()->paginate(10);
        return view('restaurants.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('restaurants.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'logo' => 'required|image|max:102400',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'desc2' => 'required|string',
            'publish_at' => 'required|date',
            'status' => 'required|in:public,private',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'number' => 'nullable|string|max:20',
            'rating' => 'nullable|string|max:10',
            'email' => 'nullable|email',
            'services' => 'nullable|string',
            'food' => 'nullable|string',
            'value' => 'nullable|string',
            'atmosphere' => 'nullable|string',
            'images.*' => 'nullable|image|max:102400',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('restaurants/logos', 'public');
        }

        $restaurant = Restaurant::create($validated);

        // Handle multiple images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('restaurant_images', 'public');
                RestaurantImage::create([
                    'restaurant_id' => $restaurant->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('restaurants.index')->with('success', 'Restaurant created successfully.');
    }

    public function show(Restaurant $restaurant)
    {
        // Record view
        RestaurantView::create([
            'restaurant_id' => $restaurant->id,
            'user_id' => auth()->id(),
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent()
        ]);

        return view('restaurant.show',[
            'restaurant' => $restaurant,
            'shareLinks' => $this->generateShareLinks($restaurant) ?? [],
            'likeCount' => $restaurant->likes()->count(), // Now this will work
            'isLiked' => $restaurant->likes()->where('user_id', auth()->id())->exists(),
            'comments' => $restaurant->comments()->with('user')->get(),
            'viewCount' => $restaurant->views()->count()
        ]);
    }

    // Add this new private method to generate share links
    private function generateShareLinks($restaurant)
    {
        $baseUrl = config('app.url');
        $url = route('home.recipes.show', $restaurant);
        $encodedUrl = urlencode($url);
        
        // Prepare content
        $title = urlencode($restaurant->name);
        $description = urlencode(Str::limit(strip_tags($restaurant->desc), 100));
        
        // Get image URL
        $imageUrl = $restaurant->images->count() 
            ? url(Storage::url($restaurant->images->first()->path))
            : url('images/default-re$restaurant.jpg');
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
    public function share(Request $request, Restaurant $restaurant)
    {
        $request->validate([
            'platform' => 'required|in:facebook,twitter,linkedin,copy_link'
        ]);

        RestaurantShare::create([
            'restaurant_id' => $restaurant->id,
            'user_id' => Auth::id(),
            'platform' => $request->platform,
            'ip_address' => request()->ip()
        ]);

        $shareLinks = $this->generateShareLinks($restaurant);
        
        if ($request->platform !== 'copy_link') {
            return redirect($shareLinks[$request->platform]);
        }

        return back()->with('success', 'Link copied to clipboard!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        return view('restaurants.edit', compact('restaurant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        $validated = $request->validate([
            'logo' => 'nullable|image|max:102400',
            'name' => 'required|string|max:255',
            'desc' => 'required|string',
            'desc2' => 'required|string',
            'publish_at' => 'required|date',
            'status' => 'required|in:public,private',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
            'number' => 'nullable|string|max:20',
            'rating' => 'nullable|string|max:10',
            'email' => 'nullable|email',
            'services' => 'nullable|string',
            'food' => 'nullable|string',
            'value' => 'nullable|string',
            'atmosphere' => 'nullable|string',
            'images.*' => 'nullable|image|max:102400',
        ]);

        // Handle logo update
        if ($request->hasFile('logo')) {
            // Delete old logo
            if ($restaurant->logo) {
                Storage::disk('public')->delete($restaurant->logo);
            }
            $validated['logo'] = $request->file('logo')->store('restaurants/logos', 'public');
        }

        $restaurant->update($validated);

        // Handle additional images upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('restaurants/images', 'public');
                RestaurantImage::create([
                    'restaurant_id' => $restaurant->id,
                    'path' => $path
                ]);
            }
        }

        return redirect()->route('restaurants.index')->with('success', 'Restaurant updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        // Delete logo
        if ($restaurant->logo) {
            Storage::disk('public')->delete($restaurant->logo);
        }

        // Delete associated images
        foreach ($restaurant->images as $image) {
            Storage::disk('public')->delete($image->path);
            $image->delete();
        }

        $restaurant->delete();

        return redirect()->route('restaurants.index')->with('success', 'Restaurant deleted successfully.');
    }

    /**
     * Remove the specified image from storage.
     */
    public function destroyImage(RestaurantImage $image)
    {
        Storage::disk('public')->delete($image->path);
        $image->delete();

        return back()->with('success', 'Image deleted successfully.');
    }

    // Additional methods for engagement features
    public function like(Restaurant $restaurant)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('continue.with')->with('error', 'You need to login to like this restaurant.');
        }
    
        $like = $restaurant->likes()->where('user_id', Auth::id())->first();
        
        if ($like) {
            $like->delete();
            $message = 'Restaurant unliked successfully.';
        } else {
            RestaurantLike::create([
                'restaurant_id' => $restaurant->id,
                'user_id' => Auth::id()
            ]);
            $message = 'Restaurant liked successfully.';
        }
    
        return back()->with('success', $message);
    }
    
    public function comment(Request $request, Restaurant $restaurant)
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('continue.with')->with('error', 'You need to login to comment.');
        }
    
        $request->validate([
            'content' => 'required|string|max:1000',
            'parent_id' => 'nullable|exists:restaurant_comments,id'
        ]);
    
        RestaurantComment::create([
            'restaurant_id' => $restaurant->id,
            'user_id' => Auth::id(),
            'content' => $request->content,
            'parent_id' => $request->parent_id
        ]);
    
        return back()->with('success', 'Comment added successfully.');
    }
}