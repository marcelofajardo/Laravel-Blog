<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentLikesController;
use App\Http\Controllers\HeroController;
use App\Http\Controllers\HeroPostController;
use App\Http\Controllers\PostCommentController;
use App\Http\Controllers\HeroPostCommentController;

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
    Route::resource('user/hero', HeroController::class)->except('index','create','store');
    Route::resource('hero.post',HeroPostController::class)->except('index');

    Route::post('post/{post}/comments',[PostCommentController::class, 'store'])->name('post.comments.store');
    Route::delete('post/{post}/comments/{comment}',[PostCommentController::class, 'destroy'])->name('post.comments.destroy');

    Route::get('hero/{hero}/post/{post}/comments/{comment}/edit', [HeroPostCommentController::class,'edit'])->name('hero.post.comments.edit');
    Route::put('hero/{hero}/post/{post}/comments/{comment}', [HeroPostCommentController::class,'update'])->name('hero.post.comments.update');

    Route::post('/comment/{comment}/like', [CommentLikesController::class, 'store'])->name('comment.like');
    Route::delete('/comment/{comment}/dislike', [CommentLikesController::class, 'destroy'])->name('comment.dislike');
});

// Route::resource('hubs', HubController::class);