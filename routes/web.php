<?php

use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect()->route('posts.index'));

Route::prefix('adm')->as('admin.')->middleware('web')->group(function () {
    Route::resource('posts', AdminPostController::class);
});

Route::prefix('blog')->as('posts.')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/{post:slug}', [PostController::class, 'show'])->name('show');
});
