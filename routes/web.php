<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HeroController;
use App\Http\Controllers\HeroPostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostLikeController;
use App\Http\Controllers\CommentLikeController;

use App\Http\Livewire\FollowButton;
use App\Http\Livewire\CreatePost;
use Illuminate\Support\Facades\Auth;

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

    // HERO
    Route::get('/users/heroes/{hero}/edit', [HeroController::class, 'edit'])->name('heroes.edit');
    Route::put('/users/heroes/{hero}', [HeroController::class, 'update'])->name('heroes.update');
    Route::post('/heroes/{hero}/follow', FollowButton::class)->name('hero.follow');

    // POST
    Route::post('/heroes/{hero}/posts', CreatePost::class)->name('hero.post.store');
    Route::resource('posts', PostController::class)->except('index', 'create');

    // COMMENT
    Route::post('/posts/{post}/comments', PostCommentController::class, )->name('posts.comments.store');
    Route::resource('comments', CommentController::class)->only('edit', 'update', 'destroy');

    // LIKE
    Route::post('/posts/{post}/like', PostLikeController::class)->name('posts.like');
    Route::post('/comments/{comment}/like', [CommentLikeController::class, 'store'])->name('comments.like');
    Route::delete('/comments/{comment}/dislike', [CommentLikeController::class, 'destroy'])->name('comments.dislike');
});

Route::get('/users/heroes/{hero}', [HeroController::class, 'show'])->name('hero.show');
Route::view('/users', 'users', ['users' => App\Models\User::latest()->paginate(20)]);
Route::view('/posts', 'post/index', ['posts' => App\Models\Post::latest()->paginate(20)]);
