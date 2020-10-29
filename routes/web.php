<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HeroController;
use App\Http\Controllers\HeroPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentLikeController;
use App\Http\Controllers\HeroFollowController;

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

Auth::login(App\Models\User::first());

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    // HERO
    Route::get('/user/hero/{hero}', [HeroController::class, 'show'])->name('hero.show');
    Route::get('/user/hero/{hero}/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/user/hero/{hero}', [HeroController::class, 'update'])->name('hero.update');

    // POST
    Route::post('/hero/{hero}/post', HeroPostController::class)->name('hero.post.store');

    Route::get('/post/{post}', [PostController::class, 'show'])->name('post.show');
    Route::get('/post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{post}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{post}', [PostController::class, 'destroy'])->name('post.destroy');

    // COMMENT
    Route::post('/post/{post}/comment', PostCommentController::class, )->name('post.comment.store');

    Route::get('/comment/{comment}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::delete('/comment/{comment}', [CommentController::class, 'destroy'])->name('comment.destroy');

    // LIKE
    Route::post('/post/{post}/like', [PostLikeController::class, 'store'])->name('post.like');
    Route::post('/comment/{comment}/like', [CommentLikeController::class, 'store'])->name('comment.like');
    Route::delete('/comment/{comment}/dislike', [CommentLikeController::class, 'destroy'])->name('comment.dislike');

    // FOLLOW
    Route::post('/hero/{hero}/follow', HeroFollowController::class)->name('hero.follow');

    Route::view('/users', 'users', ['users' => App\Models\User::latest()->paginate(20)]);
    Route::view('/posts', 'post/index', ['posts' => App\Models\Post::latest()->paginate(20)]);
});
