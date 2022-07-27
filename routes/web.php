<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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


// Home 
Route::get('/', [HomeController::class, 'home'])
    ->name('home.index');
// Contact
Route::get('/contact', [HomeController::class, 'contact'])
    ->name('home.contact');

Route::get('/secret', [HomeController::class, 'secret'])
    ->name('secret')
    ->middleware('can:home.secret');

Route::get('/single', AboutController::class)
    ->name('single');

Route::resource('posts', PostController::class);

Route::post('/comment/store', [CommentsController::class, 'store'])
    ->name('comments.store');
Route::delete('/comment/destroy', [CommentsController::class, 'destroy'])
    ->name('comments.destroy');

// Route::resource('comment', CommentsController::class)
Auth::routes();
