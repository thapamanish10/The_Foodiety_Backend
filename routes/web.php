<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\dashboard\DashboardController;
use App\Http\Controllers\announcement\AnnouncementController;
use App\Http\Controllers\products\ProductsController;
use App\Http\Controllers\image\ImageController;
use App\Http\Controllers\videos\VideosController;
use App\Http\Controllers\blog\BlogController;
use App\Http\Controllers\about\AboutController;
use App\Http\Controllers\carousel\CarouselController;
use App\Http\Controllers\about\image\AboutImageController;
use Illuminate\Support\Facades\Route;


Route::middleware(['guest'])->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

// Ensure the '/dashboard' route is only defined once and uses the appropriate middleware
Route::middleware(['auth', 'verified'])->group(function () {
    // Route to display the dashboard page
    Route::get('/dashboard', [DashboardController::class, 'viewDashbaordPage'])->name('dashboard');

    // Route to display the details page
    Route::get('/details', [DashboardController::class, 'viewDetailsPage'])->name('details');

    // Route to handle the announcement page
    Route::get('/announcement', [AnnouncementController::class, 'index'])->name('announcement');
    Route::get('/announcement/create', [AnnouncementController::class, 'create'])->name('announcement.create');

    // Route to handle the blog page
    Route::get('/blog', [BlogController::class, 'index'])->name('blog');
    Route::get('/blog/detail/{id}', [BlogController::class, 'detail'])->name('blog.detail');
    Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
    Route::post('/blog/store', [BlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');
    Route::get('/blog/image/create/{id}', [BlogController::class, 'createBlogImage'])->name('blog.image.create');
    Route::post('/blog/image/store/{id}', [BlogController::class, 'storeBlogImage'])->name('blog.image.store');
    Route::get('/blog/image/manage/{id}', [BlogController::class, 'manageBlogImage'])->name('blog.manage.image');
    Route::get('/blog/image/manage/edit/{id}', [BlogController::class, 'editBlogImage'])->name('blog.manage.image.edit');
    Route::put('/blog/image/manage/update{id}', [BlogController::class, 'updateBlogImage'])->name('blog.manage.image.update');
    Route::delete('/blog/image/manage/delete/{id}', [BlogController::class, 'deleteBlogImage'])->name('blog.manage.image.delete');

    // Route to handle the blog page
    Route::get('/business', [AboutController::class, 'index'])->name('business.index');
    Route::get('/business/create', [AboutController::class, 'create'])->name('business.create');
    Route::post('/business', [AboutController::class, 'store'])->name('business.store');
    Route::get('/business/edit/{id}', [AboutController::class, 'edit'])->name('business.edit');
    Route::put('/business//update{id}', [AboutController::class, 'update'])->name('business.update');
    Route::delete('/business/delete/{id}', [AboutController::class, 'delete'])->name('business.delete');

    Route::get('/business/image/manage/{id}', [AboutController::class, 'manageAboutImage'])->name('business.manage.image');
    Route::get('/business/image/manage/edit/{id}', [AboutController::class, 'editAboutImage'])->name('business.manage.image.edit');
    Route::put('/business/image/manage/update{id}', [AboutController::class, 'updateAboutImage'])->name('business.manage.image.update');
    Route::delete('/business/image/manage/delete/{id}', [AboutController::class, 'deleteAboutImage'])->name('business.manage.image.delete');

    // Route to handle the product image page
    Route::get('/business/image/{id}', [AboutImageController::class, 'create'])->name('business.image.create');
    Route::post('/business/image/store/{id}', [AboutImageController::class, 'store'])->name('business.image.store');
    Route::get('/business/image/edit/{id}', [AboutImageController::class, 'viewEditImageForm'])->name('business.image.edit');
    Route::post('/business/image/update/{id}', [AboutImageController::class, 'viewUpdateImageForm'])->name('business.image.update');

    // Route to handle the blog page
    Route::get('/carousel', [CarouselController::class, 'index'])->name('carousel.index');
    Route::get('/carousel/create', [CarouselController::class, 'create'])->name('carousel.create');
    Route::post('/carousel', [CarouselController::class, 'store'])->name('carousel.store');
    Route::get('/carousel/edit/{id}', [CarouselController::class, 'edit'])->name('carousel.edit');
    Route::put('/carousel/update{id}', [CarouselController::class, 'update'])->name('carousel.update');
    Route::delete('/carousel/delete/{id}', [CarouselController::class, 'delete'])->name('carousel.delete');

    // Route to handle the product page
    Route::get('/product', [ProductsController::class, 'index'])->name('product');
    Route::get('/product/create', [ProductsController::class, 'create'])->name('product.create');
    Route::post('/product/store', [ProductsController::class, 'store'])->name('product.store');
    Route::get('/product/detail/{id}', [ProductsController::class, 'detail'])->name('product.detail');
    Route::get('/product/detail/location/{id}', [ProductsController::class, 'location'])->name('product.location');
    Route::post('/product/detail/location/store{id}', [ProductsController::class, 'locationStore'])->name('product.location.store');
    Route::get('/product/detail/about/{id}', [ProductsController::class, 'about'])->name('product.about');
    Route::post('/product/detail/about/store{id}', [ProductsController::class, 'aboutStore'])->name('product.about.store');
    Route::get('/product/detail/review/{id}', [ProductsController::class, 'review'])->name('product.review');
    Route::post('/product/detail/review/store{id}', [ProductsController::class, 'reviewCreate'])->name('product.review.create');
    Route::get('/product/detail/review/edit/{id}', [ProductsController::class, 'reviewEdit'])->name('product.review.edit');
    Route::post('/product/detail/review/update/{id}', [ProductsController::class, 'reviewUpdate'])->name('product.review.update');
    Route::delete('/product/delete/{id}', [ProductsController::class, 'delete'])->name('product.delete');

    // Route to handle the product image page
    Route::get('/product/image/{id}', [ImageController::class, 'create'])->name('product.image.create');
    Route::post('/product/image/store/{id}', [ImageController::class, 'store'])->name('product.image.store');
    Route::get('/product/image/edit/{id}', [ImageController::class, 'edit'])->name('product.image.edit');
    Route::post('/product/image/update/{id}', [ImageController::class, 'update'])->name('product.image.update');
    Route::get('/product/image/manage/{id}', [ProductsController::class, 'manageImage'])->name('manage.image');
    Route::delete('/product/image/manage/delete/{id}', [ProductsController::class, 'deleteImage'])->name('manage.image.delete');
    
    Route::get('/product/video/{id}', [VideosController::class, 'create'])->name('product.video.create');
    Route::post('/product/video/store/{id}', [VideosController::class, 'store'])->name('product.video.store');
    Route::get('/product/video/edit/{id}', [VideosController::class, 'edit'])->name('product.video.edit');
    Route::post('/product/video/update/{id}', [VideosController::class, 'update'])->name('product.video.update');
    Route::delete('/product/video/manage/delete/{id}', [VideosController::class, 'deleteVideo'])->name('manage.video.delete');





    // Profile routes
    Route::get('/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');
    Route::get('/setting', [ProfileController::class, 'editSetting'])->name('setting.edit');
    Route::get('/profile/delete', [ProfileController::class, 'viewProfileDelete'])->name('profile.delete');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
