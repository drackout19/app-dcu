<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', function () {
    return view('loginPage');
});

Route::get('/beranda', function () {
    return view('beranda');
});

Route::get('/posts', [PostController::class, 'index']);

// sama saja
// Route::get('/post/{slug}', [PostController::class, 'show']);
Route::get('/post/{post:slug}', [PostController::class, 'show']);

Route::get('/categories', function() {
    return view('categories', [
        "categories" => App\Models\Category::all()
    ]);
});

Route::get('/categories/{category:slug}', function(App\Models\Category $category) {
    return view('category', [
        "title" => $category->name,
        "posts" => $category->posts,
        "category" => $category->name
    ]);     
});
// ----------------------------------------------------------