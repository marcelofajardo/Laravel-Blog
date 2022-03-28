<?php
use Illuminate\Support\Facades\Route;

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

Route::view('/users', 'users', ['users' => \App\Models\User::latest()->paginate(20)]);
Route::view('/posts', 'post/index', ['posts' => \App\Models\Post::latest()->paginate(20)]);

Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');
    Route::resource('users/heroes', \App\Http\Controllers\HeroController::class)->only(['show', 'edit', 'update']);
    Route::get('/posts/{post}', \App\Http\Livewire\Post\Show::class)->name('posts.show');
});
