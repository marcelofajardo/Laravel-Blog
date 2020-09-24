<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HeroController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentLikeController;

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

    Route::resource('user/hero', HeroController::class)->only('show', 'edit', 'update');
    Route::resource('post', PostController::class)->except('index', 'create');
    Route::resource('post.comments', PostCommentController::class)->only('store');
    Route::resource('comment', CommentController::class)->only('edit', 'update', 'delete');

    // LIKE
    Route::post('/post/{post}/like', [PostLikeController::class, 'store'])->name('comment.like');
    Route::post('/comment/{comment}/like', [CommentLikeController::class, 'store'])->name('comment.like');
    Route::delete('/comment/{comment}/dislike', [CommentLikeController::class, 'destroy'])->name('comment.dislike');

    // Route::view('/hubs', 'hubs', ['post' => Post::latest()->paginate(20)]);
});
