<?php

use App\Http\Controllers\Admin\Post\CreateController;
use App\Http\Controllers\Admin\Post\DestroyController;
use App\Http\Controllers\Admin\Post\EditController;
use App\Http\Controllers\Admin\Post\IndexController;
use App\Http\Controllers\Admin\Post\ShowController;
use App\Http\Controllers\Admin\Post\StoreController;
use App\Http\Controllers\Admin\Post\UpdateController;

use App\Http\Controllers\Admin\StatisticsController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\ThirdPartyPostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth'])->group(function () {
    Route::get('post', [PostController::class, 'index'])->name('post.index');
    Route::get('post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('post/create', [PostController::class, 'store'])->name('post.store');
    Route::get('post/kufar', [ThirdPartyPostController::class, 'index'])->name('post.kufar');
    Route::get('post/recommendations', [PostController::class, 'recommendations'])->name('post.recommendations');
    Route::delete('post/{post}/destroy', [PostController::class, 'destroy'])->name('post.destroy');
    Route::get('post/{post}', [PostController::class, 'show'])->name('post.show');
    Route::get('post/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::patch('post/{post}', [PostController::class, 'update'])->name('post.update');

    Route::post('post/{post}/picture/create', [PictureController::class, 'store'])
        ->name('post.picture.store');
    Route::get('post/{post}/picture/create', [PictureController::class, 'create'])
        ->name('post.picture.create');

    Route::post('post/{post}/review/create', [ReviewController::class, 'store'])->name('post.review.store');
    Route::delete('post/{post}/review/{review}/destroy', [ReviewController::class, 'destroy'])
        ->name('post.review.destroy');
    Route::get('post/{post}/review/{review}/edit', [ReviewController::class, 'edit'])->name('post.review.edit');
    Route::patch('post/{post}/review/{review}', [ReviewController::class, 'update'])->name('post.review.update');

    Route::post('post/{post}/appointment/create', [AppointmentController::class, 'store'])
        ->name('post.appointment.store');
    Route::delete('post/{post}/appointment/{appointment}/destroy', [AppointmentController::class, 'destroy'])
        ->name('post.appointment.destroy');
    Route::get('post/{post}/appointment/{appointment}/edit', [AppointmentController::class, 'edit'])
        ->name('post.appointment.edit');
    Route::patch('post/{post}/appointment/{appointment}', [AppointmentController::class, 'update'])
        ->name('post.appointment.update');

    Route::post('post/search', [PostController::class, 'search'])->name('post.search');
    Route::post('post/document/{filepath}', [PostController::class, 'downloadFile'])->name('post.file.download');
    Route::get('job/{id?}', [JobController::class, 'index'])->name('job.index');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [IndexController::class, 'index'])->name('admin.index');

    Route::get('/admin/post', [IndexController::class, 'index'])->name('admin.post');
    Route::get('/admin/post/sort/{field}/{direction}', [IndexController::class, 'sort'])->name('admin.post.sort');
    Route::get('admin/post/create', [CreateController::class, '__invoke'])->name('admin.post.create');
    Route::post('admin/post/create', [StoreController::class, '__invoke'])->name('admin.post.store');
    Route::delete('admin/post/{post}/destroy', [DestroyController::class, '__invoke'])->name('admin.post.destroy');
    Route::get('admin/post/{post}', [ShowController::class, '__invoke'])->name('admin.post.show');
    Route::get('admin/post/{post}/edit', [EditController::class, '__invoke'])->name('admin.post.edit');
    Route::patch('admin/post/{post}', [UpdateController::class, '__invoke'])->name('admin.post.update');

    Route::get('/admin/user', [\App\Http\Controllers\Admin\User\IndexController::class, '__invoke'])
        ->name('admin.user');
    Route::get('admin/user/create', [\App\Http\Controllers\Admin\User\CreateController::class, '__invoke'])
        ->name('admin.user.create');
    Route::post('admin/user/create', [\App\Http\Controllers\Admin\User\StoreController::class, '__invoke'])
        ->name('admin.user.store');
    Route::delete('admin/user/{user}/destroy', [\App\Http\Controllers\Admin\User\DestroyController::class, '__invoke'])
        ->name('admin.user.destroy');
    Route::get('admin/user/{user}', [\App\Http\Controllers\Admin\User\ShowController::class, '__invoke'])
        ->name('admin.user.show');
    Route::get('admin/user/{user}/edit', [\App\Http\Controllers\Admin\User\EditController::class, '__invoke'])
        ->name('admin.user.edit');
    Route::patch('admin/user/{user}', [\App\Http\Controllers\Admin\User\UpdateController::class, '__invoke'])
        ->name('admin.user.update');
    // Route::get('/admin/statistics', StatisticsController::class)->name('admin.statistics');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/home', \App\Http\Controllers\User\IndexController::class)->name('home.index');
    Route::delete('home/appointment/{appointment}/destroy', [AppointmentController::class, 'destroy'])->name('home.appointment.destroy');
    Route::get('home/appointment/{appointment}/edit', [AppointmentController::class, 'edit'])->name('home.appointment.edit');
    Route::patch('home/appointment/{appointment}', [AppointmentController::class, 'update'])->name('home.appointment.update');

});
Route::get('/user/{user}', [\App\Http\Controllers\User\ShowController::class, '__invoke'])->name('user.show');

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
