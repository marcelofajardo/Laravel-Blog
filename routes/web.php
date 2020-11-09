<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    HeroController,
    HeroPostController,
    PostController,
    PostCommentController,
    CommentController,
    PostLikeController,
    CommentLikeController
};

use App\Http\Livewire\{FollowButton, CreatePost};

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
// TODO: Refactor auth middleware

// Auth::login(App\Models\User::first());
// Auth::logout();

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    // HERO
    Route::get('/user/hero/{hero}/edit', [HeroController::class, 'edit'])->name('hero.edit');
    Route::put('/user/hero/{hero}', [HeroController::class, 'update'])->name('hero.update');

    // POST
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
    Route::post('/hero/{hero}/follow', FollowButton::class)->name('hero.follow');
    Route::post('/hero/{hero}/post', CreatePost::class)->name('hero.post.store');

});

Route::get('/user/hero/{hero}', [HeroController::class, 'show'])->name('hero.show');
Route::view('/users', 'users', ['users' => App\Models\User::latest()->paginate(20)]);
Route::view('/posts', 'post/index', ['posts' => App\Models\Post::latest()->paginate(20)]);
