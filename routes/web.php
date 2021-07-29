<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HeroController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentLikeController;

use App\Http\Livewire\FollowButton;

use App\Models\Post;
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
    return view('welcome');
});

Route::view('/users', 'users', ['users' => User::latest()->paginate(20)]);
Route::view('/posts', 'post/index', ['posts' => Post::latest()->paginate(20)]);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // HERO
    Route::resource('users/heroes', HeroController::class)->only(['show', 'edit', 'update']);
    Route::post('/heroes/{hero}/follow', FollowButton::class)->name('heroes.follow');

    // POST
    Route::resource('posts', PostController::class)->except(['index', 'create']);

    // COMMENT
    Route::post('/posts/{post}/comments', PostCommentController::class,)->name('posts.comments.store');
    Route::resource('comments', CommentController::class)->only('edit', 'update', 'destroy');

    // LIKE
    Route::post('/posts/{post}/like', PostLikeController::class)->name('posts.like');
    Route::post('/comments/{comment}/like', [CommentLikeController::class, 'store'])->name('comments.like');
    Route::delete('/comments/{comment}/dislike', [CommentLikeController::class, 'destroy'])->name('comments.dislike');
});
