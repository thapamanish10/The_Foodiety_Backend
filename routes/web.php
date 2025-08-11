<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\announcement\AnnouncementController;
use App\Http\Controllers\about\AboutController;
use App\Http\Controllers\AIController;
use App\Http\Controllers\AIVideoController;
use App\Http\Controllers\carousel\CarouselController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GoogleController;
use App\Http\Controllers\message\MessageController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;
use App\Models\About;
use App\Models\Carousel;
use App\Models\Restaurant;

// Route::middleware(['guest'])->group(function () {
//     Route::get('/', function () {
//         return view('auth.login');
//     });
// });
Route::get('/', function () {
    $carousels = Carousel::all();
    $abouts = About::all();
    $restaurants = Restaurant::with(['images', 'likes', 'comments', 'views'])
        ->withCount(['likes', 'comments', 'views'])
        ->latest()
        ->take(3)
        ->get();
        
    return view('welcome', compact('restaurants', 'carousels', 'abouts'));
});

Route::get('/debug-restaurants', function() {
    $restaurants = Restaurant::with('images')->get();
    return response()->json([
        'storage_link_exists' => file_exists(public_path('storage')),
        'restaurants' => $restaurants->map(function($restaurant) {
            return [
                'name' => $restaurant->name,
                'logo' => $restaurant->logo,
                'images' => $restaurant->images->map(function($image) {
                    return [
                        'path' => $image->path,
                        'full_path' => storage_path('app/public/' . $image->path),
                        'exists' => file_exists(storage_path('app/public/' . $image->path))
                    ];
                }),
                'logo_exists' => $restaurant->logo ? file_exists(storage_path('app/public/' . $restaurant->logo)) : false
            ];
        })
    ]);
});
Route::get('home/contact', function () {
     $abouts = About::all();
    return view('Frontend.pages.contact.contact', compact('abouts'));
})->name("home.contact.index");


Route::get('/continue/with', function () {
    return view('continue');
})->name('continue.with');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::prefix('users')->group(function () {
        // Accessible to both admin and super_admin
        Route::get('/', [UserController::class, 'index'])->name('users.index');
        
        // Password reset (for both)
        Route::get('/{user}/reset-password', [UserController::class, 'showResetPasswordForm'])
            ->name('users.reset-password');
        Route::post('/{user}/reset-password', [UserController::class, 'resetPassword'])
            ->name('users.reset-password.update');
            
        // Super admin only routes
        Route::middleware('superadmin')->group(function () {
            Route::post('/{user}/update-role', [UserController::class, 'updateRole'])
                ->name('users.update-role');
        });
        Route::delete('/users/{user}', [UserController::class, 'destroy'])
            ->name('users.destroy')
            ->middleware(['auth', 'superadmin']);
    });
});
Route::resource('services', ServiceController::class);
Route::get('/home/services', [ServiceController::class, 'homePageServices'])->name('home.services.index');
Route::get('/home/services/{service}', [ServiceController::class, 'homePageServicesDetail'])->name('home.services.show');
Route::resource('business', AboutController::class);
Route::get('/home/business', [AboutController::class, 'homePageAbouts'])->name('home.business.index');
Route::get('/home/business/{busines}', [AboutController::class, 'homePageAboutsDetail'])->name('home.business.show');

Route::resource('categories', CategoryController::class);
Route::resource('restaurants',RestaurantController::class);
Route::post('/restaurants/{restaurant}/like', [RestaurantController::class, 'like'])->name('restaurants.like');
Route::post('/restaurants/{restaurant}/comment', [RestaurantController::class, 'comment'])->name('restaurants.comment');
Route::post('/restaurants/{restaurant}/share', [RestaurantController::class, 'share'])->name('restaurants.share');
Route::delete('restaurants/images/{image}', [RestaurantController::class, 'destroyImage'])->name('restaurants.destroyImage');
Route::get('/welcome/restaurants', [RestaurantController::class, 'welcomePageRestaurants'])->name('welcome.restaurants.index');
Route::get('/home/restaurants', [RestaurantController::class, 'homePageRestaurants'])->name('home.restaurants.index');
Route::get('/home/restaurants/{restaurant}', [RestaurantController::class, 'homePageRestaurantsDetail'])->name('home.restaurants.show');

Route::prefix('galleries')->group(function () {
    Route::get('/', [GalleryController::class, 'index'])->name('galleries.index');
    Route::get('/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::post('/', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('/{gallery}', [GalleryController::class, 'show'])->name('galleries.show');
    Route::get('/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    Route::get('/{gallery}/download', [GalleryController::class, 'download'])->name('galleries.download');
});
Route::get('home/galleries', [GalleryController::class, 'frontendGallery'])->name('home.galleries.index');
Route::get('home/galleries/{gallery}', [GalleryController::class, 'frontendGalleryShow'])->name('home.galleries.show');

Route::prefix('ais')->group(function () {
    Route::get('/', [AIController::class, 'index'])->name('ais.index');
    Route::get('/create', [AIController::class, 'create'])->name('ais.create');
    Route::post('/', [AIController::class, 'store'])->name('ais.store');
    Route::get('/{ai}', [AIController::class, 'show'])->name('ais.show');
    Route::get('/{ai}/edit', [AIController::class, 'edit'])->name('ais.edit');
    Route::put('/{ai}', [AIController::class, 'update'])->name('ais.update');
    Route::delete('/{ai}', [AIController::class, 'destroy'])->name('ais.destroy');
    Route::get('/{ai}/download', [AIController::class, 'download'])->name('ais.download');
});
Route::get('home/ais', [AIController::class, 'frontendAI'])->name('home.ais.index');
Route::get('home/ais/{ai}', [AIController::class, 'frontendAIShow'])->name('home.ais.show');




Route::get('home/videos/{video}', [GalleryController::class, 'frontendVideoShow'])->name('home.videos.show');
Route::get('home/ai-videos/{video}', [AIController::class, 'frontendVideoShow'])->name('home.ai-videos.show');

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::resource('videos', VideoController::class);
Route::get('videos/{video}/download', [VideoController::class, 'download'])
     ->name('videos.download');
     
// Equivalent to Route::resource('ai-videos', AIVideoController::class);

// Index - List all AI videos
Route::get('ai-videos', [AIVideoController::class, 'index'])->name('ai-videos.index');
Route::get('ai-videos/create', [AIVideoController::class, 'create'])->name('ai-videos.create');
Route::post('ai-videos', [AIVideoController::class, 'store'])->name('ai-videos.store');
Route::get('ai-videos/{ai_video}', [AIVideoController::class, 'show'])->name('ai-videos.show');
Route::get('ai-videos/{ai_video}/edit', [AIVideoController::class, 'edit'])->name('ai-videos.edit');
Route::match(['PUT', 'PATCH'], 'ai-videos/{ai_video}', [AIVideoController::class, 'update'])->name('ai-videos.update');
Route::delete('ai-videos/{ai_video}', [AIVideoController::class, 'destroy'])->name('ai-videos.destroy');
Route::get('ai-videos/{video}/download', [AIVideoController::class, 'download'])
     ->name('ai-videos.download');


Route::resource('blogs', BlogController::class);
Route::get('/home/blogs', [BlogController::class, 'homePageBlogs'])->name('home.blogs.index');
Route::get('/home/blogs/{blog}', [BlogController::class, 'homePageBlogsDetail'])->name('home.blogs.show');
Route::post('/blogs/{blog}/like', [BlogController::class, 'like'])->name('blogs.like');
Route::post('/blogs/{blog}/comment', [BlogController::class, 'comment'])->name('blogs.comment');
Route::post('/blogs/{blog}/share', [BlogController::class, 'share'])->name('blogs.share');
Route::delete('/blog-images/{image}', [BlogController::class, 'deleteImage'])->name('blog-images.destroy');

Route::resource('recipes', RecipeController::class);
Route::get('/home/recipes', [RecipeController::class, 'homePagerecipes'])->name('home.recipes.index');
Route::get('/home/recipes/{recipe}', [RecipeController::class, 'homePageRecipesDetail'])->name('home.recipes.show');
Route::post('/recipes/{recipe}/like', [RecipeController::class, 'like'])->name('recipes.like');
Route::post('/recipes/{recipe}/comment', [RecipeController::class, 'comment'])->name('recipes.comment');
Route::post('/recipes/{recipe}/share', [RecipeController::class, 'share'])->name('recipes.share');








// Ensure the '/dashboard' route is only defined once and uses the appropriate middleware
Route::get('/admin/dashboard', [DashboardController::class, 'adminDashboard'])->middleware('auth')->name('dashboard');

Route::get('/auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);



















    // Route to display the dashboard page

    // Route to display the details page
    Route::get('/details', [DashboardController::class, 'viewDetailsPage'])->name('details');

    // Route to handle the announcement page
    Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement');
    Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');


    // Route to handle the blog page
    Route::resource('/carousel', CarouselController::class);
    Route::get('/home/carousel', [CarouselController::class, 'welcomePageCarousel'])
    ->name('home.carousel.index');

    Route::middleware(['auth', 'verified'])->group(function () {


    // // Route to handle the product page
    // Route::get('/product', [ProductsController::class, 'index'])->name('product');
    // Route::get('/product/create', [ProductsController::class, 'create'])->name('product.create');
    // Route::post('/product/store', [ProductsController::class, 'store'])->name('product.store');
    // Route::get('/product/detail/{id}', [ProductsController::class, 'detail'])->name('product.detail');
    // Route::get('/product/detail/location/{id}', [ProductsController::class, 'location'])->name('product.location');
    // Route::post('/product/detail/location/store{id}', [ProductsController::class, 'locationStore'])->name('product.location.store');
    // Route::get('/product/detail/about/{id}', [ProductsController::class, 'about'])->name('product.about');
    // Route::post('/product/detail/about/store{id}', [ProductsController::class, 'aboutStore'])->name('product.about.store');
    // Route::get('/product/detail/review/{id}', [ProductsController::class, 'review'])->name('product.review');
    // Route::post('/product/detail/review/store{id}', [ProductsController::class, 'reviewCreate'])->name('product.review.create');
    // Route::get('/product/detail/review/edit/{id}', [ProductsController::class, 'reviewEdit'])->name('product.review.edit');
    // Route::post('/product/detail/review/update/{id}', [ProductsController::class, 'reviewUpdate'])->name('product.review.update');
    // Route::delete('/product/delete/{id}', [ProductsController::class, 'delete'])->name('product.delete');

    // // Route to handle the product image page
    // Route::get('/product/image/{id}', [ImageController::class, 'create'])->name('product.image.create');
    // Route::post('/product/image/store/{id}', [ImageController::class, 'store'])->name('product.image.store');
    // Route::get('/product/image/edit/{id}', [ImageController::class, 'edit'])->name('product.image.edit');
    // Route::post('/product/image/update/{id}', [ImageController::class, 'update'])->name('product.image.update');
    // Route::get('/product/image/manage/{id}', [ProductsController::class, 'manageImage'])->name('manage.image');
    // Route::delete('/product/image/manage/delete/{id}', [ProductsController::class, 'deleteImage'])->name('manage.image.delete');
    
    // Route::get('/product/video/{id}', [VideosController::class, 'create'])->name('product.video.create');
    // Route::post('/product/video/store/{id}', [VideosController::class, 'store'])->name('product.video.store');
    // Route::get('/product/video/edit/{id}', [VideosController::class, 'edit'])->name('product.video.edit');
    // Route::post('/product/video/update/{id}', [VideosController::class, 'update'])->name('product.video.update');
    // Route::delete('/product/video/manage/delete/{id}', [VideosController::class, 'deleteVideo'])->name('manage.video.delete');





    // Profile routes
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::get('/setting', [ProfileController::class, 'editSetting'])->name('setting.edit');
    Route::get('/profile/delete', [ProfileController::class, 'viewProfileDelete'])->name('profile.delete');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

    Route::get('/messages', [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/create', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/messages/store', [MessageController::class, 'store'])->name('messages.store');
    Route::post('/messages/{id}/mark-as-read', [MessageController::class, 'markAsRead'])->name('messages.markAsRead');
    Route::delete('/messages/delete/{id}', [MessageController::class, 'delete'])->name('messages.delete');