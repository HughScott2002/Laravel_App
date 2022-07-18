<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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


$posts = [
    1 => [
        'title' => 'Intro to Laravel',
        'content' => 'This is a short intro to Laravel',
        'is_new' => true,
        'has_comments' => true
    ],
    2 => [
        'title' => 'Intro to PHP',
        'content' => 'This is a short intro to PHP',
        'is_new' => false
    ]
];

$test = [
    1 => [
        'name' => 'Jeff',
        'age' => 23,
        'gender' => 'male',
        'logging' => true
    ],
    2 => [
        'name' => 'Jenna',
        'age' => 29,
        'gender' => 'female',
        'logging' => false
    ],
    3 => [
        'name' => 'John',
        'age' => 17,
        'gender' => 'male',
        'logging' => true
    ]
];

// Home 
Route::get('/', [HomeController::class, 'home'])
    ->name('home.index');
// Contact
Route::get('/contact', [HomeController::class, 'contact'])
    ->name('home.contact');

Route::get('/single', AboutController::class)
    ->name('single');

Route::resource('posts', PostController::class);






// // post/id
// Route::get('/post/{days?}', function ($days = 1) {
//     return 'Posts from ' . $days . ' days ago';
// })
//     ->where(['days' => '[0-9]+'])
//     ->name('home.posts-days');

// // posts
// Route::get('/posts', function () use ($posts) {
//     // compact($posts) === ['posts' => $posts])
//     return view('posts.index', ['posts' => $posts]);
// });
// // posts/id
// Route::get('/posts/{id?}', function ($id = 1) use ($posts) {
//     abort_if(!isset($posts[$id]), 404, 'Not Found');

//     return view('posts.show', ['post' => $posts[$id]]);
// })->name('post.show');

// array_test
Route::get('/array_test', function () use ($test) {
    abort_if(!count($test), 404);
    return view('array.index', ['test' => $test]);
})->name('array.index');

// array_test/id?
Route::get('/array_test/{id?}', function ($id = 0) use ($test) {
    abort_if(!isset($test[$id]), 404);
    return view('array.show', ['test' => $test[$id]]);
})->name('array.show');


// Route::prefix('/fun', function())