<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\products\ProductsController;
use App\Http\Controllers\image\ImageController;
use App\Http\Controllers\videos\VideosController;
use App\Http\Controllers\about\AboutController;
use App\Http\Controllers\carousel\CarouselController;
use App\Http\Controllers\about\image\AboutImageController;
use App\Http\Controllers\blog\BlogController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/product', [ProductsController::class, 'productAPI'])->name('product');
Route::get('/product/{id}', [ProductsController::class, 'productDetailAPI'])->name('productDetailAPI');
Route::get('/image', [ImageController::class, 'productImageAPI'])->name('image');
Route::get('/video', [VideosController::class, 'productVideoAPI'])->name('video');
Route::get('/carousel', [CarouselController::class, 'carouselImageAPI'])->name('carousel');
Route::get('/about', [AboutController::class, 'aboutAPI'])->name('about');
Route::get('/aboutImage', [AboutImageController::class, 'aboutImageAPI'])->name('aboutImage');
Route::get('/blogs', [BlogController::class, 'blogAPI'])->name('blogs');
Route::get('/blogImage', [BlogController::class, 'blogImageAPI'])->name('blogImage');
Route::get('/blog/{id}', [BlogController::class, 'blogSingelAPI'])->name('blogSingelAPI');