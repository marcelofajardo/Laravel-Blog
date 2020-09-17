<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CommentLikesController;

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
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::resource('post.comments', PostCommentController::class)->except('index', 'create', 'show');
    Route::resource('posts', PostController::class);
    Route::post('/comment/{comment}/like', [CommentLikesController::class, 'store'])->name('comment.like');
    Route::delete('/comment/{comment}/dislike', [CommentLikesController::class, 'destroy'])->name('comment.dislike');
});
