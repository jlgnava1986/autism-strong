<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/gallery', 'App\Http\Controllers\GalleryController@index');
Route::get('/gallery/create', 'App\Http\Controllers\GalleryController@create')->name('gallery-create');
Route::post('/gallery/store', 'App\Http\Controllers\GalleryController@store')->name('gallery-store');
Route::get('/gallery/{id}', 'App\Http\Controllers\GalleryController@show')->name('gallery-show');
Route::delete('/gallery/{id}', 'App\Http\Controllers\GalleryController@destroy')->name('gallery-destroy');

Route::get('/photos/create/{galleryId}', 'App\Http\Controllers\PhotosController@create')->name('photo-create');
Route::post('/photos/store', 'App\Http\Controllers\PhotosController@store')->name('photo-store');
Route::get('/photos/{id}', 'App\Http\Controllers\PhotosController@show')->name('photo-show');
Route::delete('/photos/{id}', 'App\Http\Controllers\PhotosController@destroy')->name('photo-destroy');

Route::get('/contact', 'App\Http\Controllers\ContactController@contact');
Route::post('/send-message', 'App\Http\Controllers\ContactController@sendEmail')->name('contact-send');

Route::get('login/facebook', 'App\Http\Controllers\Auth\LoginController@redirectToFacebook')->name('login-facebook');
Route::get('login/facebook/callback', 'App\Http\Controllers\Auth\LoginController@handleFacebookCallback');