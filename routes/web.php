<?php

use App\Http\Controllers\HomePageController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomePageController::class, 'index'])->name('home.index');

Route::get('post', [PostController::class, 'index'])->name('post.index');

Route::get('post/create', [PostController::class, 'create'])->name('post.create');
Route::post('post/create', [PostController::class, 'store'])->name('post.store');

Route::delete('post/{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');

Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');

Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('post/{post}', [PostController::class, 'update'])->name('post.update');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
