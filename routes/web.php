<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Input;
use App\Models\User;
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
    return view('blogosphere');
});
Route::get('/about', function () {
    return view('about-us');
});
Route::post('/add/image', function () {
        return view('add_image');
});


Auth::routes();

Route::middleware(['auth'])->group(function (){
    //***********       Profile     ***************//
    Route::get('/profile', [App\Http\Controllers\PageController::class, 'profile'])->name('profile');
    //***********       Post     ***************//
    Route::get('/add', [App\Http\Controllers\PageController::class, 'add'])->name('add');
    Route::post('/add/image', [App\Http\Controllers\PostController::class, 'store'])->name('add_image');
    Route::get('/edit/delete/{slug}', [App\Http\Controllers\PostController::class, 'delete'])->name('delete');
    Route::post('/post/edit/{slug}', [App\Http\Controllers\PostController::class, 'update'])->name('update');
    Route::get('/edit/{slug}', [App\Http\Controllers\PostController::class, 'edit'])->name('edit');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/home/upload', [App\Http\Controllers\ImageController::class, 'upload'])->name('home-upload');
//Route::post('/post', [App\Http\Controllers\PostController::class, 'store'])->name('store');
Route::post('/post/image', [App\Http\Controllers\ImageController::class, 'uploadPostImages'])->name('upload');
Route::get('/post/random', [App\Http\Controllers\PostController::class, 'random'])->name('random');
Route::get('/read', [App\Http\Controllers\PostController::class, 'index'])->name('read');
Route::get('/read/{theme}', [App\Http\Controllers\PostController::class, 'theme'])->name('theme');
Route::get('/article/{slug}', [App\Http\Controllers\PostController::class, 'showPost'])->name('show');
