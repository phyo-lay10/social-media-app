<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UiController;
use Illuminate\Support\Facades\Route;

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

// home
Route::get('/', [UiController::class, 'index'])->name('index');

// register
Route::get('register', [AuthController::class, 'register'])->name('registerForm');
Route::post('register', [AuthController::class, 'registerStore'])->name('register.store');

// login
Route::get('login', [AuthController::class, 'login'])->name('loginForm');
Route::post('login', [AuthController::class, 'loginStore'])->name('login.store');

// logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// post
Route::resource('posts', PostController::class);

// comment
Route::post('posts/comment/{postId}', [CommentController::class, 'comment'])->name('comment');
Route::get('posts/comment/{commentId}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::put('posts/comment/{commentId}', [CommentController::class, 'update'])->name('comments.update');
Route::delete('posts/comment/{commentId}/delete', [CommentController::class, 'destroy'])->name('comments.delete');

