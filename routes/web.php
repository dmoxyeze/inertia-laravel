<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/categories', [CategoryController::class, 'index'])->name('category');
Route::post('/categories', [CategoryController::class, 'store'])->name('store-category');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('update-category');
Route::delete('/categories/{id}', [CategoryController::class, 'delete_category'])->name('delete-category');
Route::get('/posts', [PostController::class, 'index'])->name('posts');
Route::post('/posts', [PostController::class, 'store'])->name('posts');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('update-post');
Route::delete('/posts/{id}', [PostController::class, 'delete_post'])->name('delete-post');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->name('dashboard');
