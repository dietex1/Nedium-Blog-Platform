<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\LikesController;


Route::get('/', [PostController::class, 'index'])->name('dashboard');

Route::get('/category/{category}', [PostController::class, 'category'])->name('post.byCategory');

Route::get('/u/{user:username}', [PublicProfileController::class, 'show'])->name('profile.show');

Route::get('/u/{username}/{post:slug}',[PostController::class, 'show'])->name('post.show');


Route::middleware('auth','verified')->group(function () {
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/follow/{user}', [FollowerController::class, 'followUnfollow'])->name('follow');
    Route::post('/likes/{post}', [LikesController::class, 'likes'])->name('likes');

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
