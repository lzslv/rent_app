<?php

use App\Http\Controllers\Admin\Post\CreateController;
use App\Http\Controllers\Admin\Post\DestroyController;
use App\Http\Controllers\Admin\Post\EditController;
use App\Http\Controllers\Admin\Post\IndexController;
use App\Http\Controllers\Admin\Post\ShowController;
use App\Http\Controllers\Admin\Post\StoreController;
use App\Http\Controllers\Admin\Post\UpdateController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::get('post', [PostController::class, 'index'])->name('post.index');
Route::get('post/create', [PostController::class, 'create'])->name('post.create');
Route::post('post/create', [PostController::class, 'store'])->name('post.store');
Route::delete('post/{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
Route::patch('post/{post}', [PostController::class, 'update'])->name('post.update');


Route::get('/admin', [IndexController::class, '__invoke'])->name('admin.index');

Route::get('/admin/post', [IndexController::class, '__invoke'])->name('admin.post');
Route::get('admin/post/create', [CreateController::class, '__invoke'])->name('admin.post.create');
Route::post('admin/post/create', [StoreController::class, '__invoke'])->name('admin.post.store');
Route::delete('admin/post/{post}/destroy', [DestroyController::class, '__invoke'])->name('admin.post.destroy');
Route::get('admin/post/{post}', [ShowController::class, '__invoke'])->name('admin.post.show');
Route::get('admin/post/{post}/edit', [EditController::class, '__invoke'])->name('admin.post.edit');
Route::patch('admin/post/{post}', [UpdateController::class, '__invoke'])->name('admin.post.update');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/admin/user', [\App\Http\Controllers\Admin\User\IndexController::class, '__invoke'])->name('admin.user');
Route::get('admin/user/create', [\App\Http\Controllers\Admin\User\CreateController::class, '__invoke'])->name('admin.user.create');
Route::post('admin/user/create', [\App\Http\Controllers\Admin\User\StoreController::class, '__invoke'])->name('admin.user.store');
Route::delete('admin/user/{user}/destroy', [\App\Http\Controllers\Admin\User\DestroyController::class, '__invoke'])->name('admin.user.destroy');
Route::get('admin/user/{user}', [\App\Http\Controllers\Admin\User\ShowController::class, '__invoke'])->name('admin.user.show');
Route::get('admin/user/{user}/edit', [\App\Http\Controllers\Admin\User\EditController::class, '__invoke'])->name('admin.user.edit');
Route::patch('admin/user/{user}', [\App\Http\Controllers\Admin\User\UpdateController::class, '__invoke'])->name('admin.user.update');
