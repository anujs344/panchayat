<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/hoo', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('route:cache');
        Artisan::call('config:cache');

    Artisan::call('optimize:clear');
    return "clear";
});

Route::get('/',[App\Http\Controllers\Home\HomeController::class,'index'])->name('home');
Route::get('/stories',[App\Http\Controllers\Home\StoriesController::class,'stories'])->name('stories');
Route::get('/gallery',[App\Http\Controllers\Home\GalleryController::class,'gallery'])->name('gallery');

Route::prefix('subscribe')->name('subscribe.')->group(function () {
    Route::get('/',[App\Http\Controllers\Home\HomeController::class,'subscribe'])->name('view');
});

// Post view
Route::prefix('post')->name('post.')->group(function () {
    Route::get('/view/{type}/{slug}', [App\Http\Controllers\Home\ViewController::class, 'show'])->name('view');
    // Author Post view
    Route::get('/author/{user}', [App\Http\Controllers\Home\ViewController::class, 'author'])->name('author');
    // video
    Route::get('/video', [App\Http\Controllers\Home\ViewController::class, 'video'])->name('video');
    // article
    Route::get('/article', [App\Http\Controllers\Home\ViewController::class, 'article'])->name('article');
    // tags
    Route::get('/tags/{tag}', [App\Http\Controllers\Home\ViewController::class, 'tag'])->name('tag');
    // from location
    Route::get('/locations/{location}', [App\Http\Controllers\Home\ViewController::class, 'fromLocationPost'])->name('fromLocationPost');
    // post comment
    Route::post('/store/{post}', [App\Http\Controllers\Home\ViewController::class, 'store'])->name('store');
});

Route::prefix('categories')->name('category.')->group(function () {
    Route::get('/{slug}',[App\Http\Controllers\Home\CategoryController::class,'categories'])->name('view');
});
Route::prefix('subcategories')->name('subcategory.')->group(function () {
    Route::get('/{slug}',[App\Http\Controllers\Home\CategoryController::class,'subcategories'])->name('view');
});

Route::get('/donate',[App\Http\Controllers\Home\DonateController::class,'donate'])->name('donate');
Route::get('/about',[App\Http\Controllers\Home\AboutController::class,'about'])->name('about');
Route::post('/newsletter-subscribe',[App\Http\Controllers\Home\HomeController::class,'newsletterSubscribe'])->name('newsletterSubscribe');


Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cleared!";
});



// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return view('dashboard');
// })->name('dashboard');