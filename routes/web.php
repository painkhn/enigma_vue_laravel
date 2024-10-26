<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\{ Category };
use Inertia\Inertia;

Route::controller(App\Http\Controllers\ThemeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/theme/create', function() {
        $categories = Category::get();
        return Inertia::render('ThemeCreate', ['categories' => $categories]);
    })->name('themeCreate')->middleware('auth');
    Route::get('/theme/{id}', 'show')->name('themeShow');
    Route::post('/theme/new',  'store')->name('new_theme');
    Route::delete('/theme/delete/{theme}',  'destroy')->name('delete_theme');
    Route::patch('/theme/update/{theme}',  'update')->name('update_theme');
    Route::post('/search', 'search')->name('search');
    Route::get('/category/{id}', 'filterByCategory')->name('filter_by_category');
    Route::get('/theme/download/{id}', 'download')->name('download_theme');
});

Route::controller(App\Http\Controllers\ProfileController::class)->group(function() {
    Route::middleware('auth')->group(function () {
        Route::get('/users/{name}', 'profileIndex')->name('profile');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::patch('/profile/update',  'update')->name('profile.update');
        Route::delete('/profile/destroy', 'destroy')->name('profile.destroy');
        Route::post('/profile/new_avatar', 'updateAvatar')->name('new_avatar');
        Route::get('/profile/download/{name}', 'download')->name('download_profile');
    });
});

Route::controller(App\Http\Controllers\CategoryController::class)->group(function() {
    Route::post('category/new', 'store')->name('new_category');
    Route::delete('/category/delete/{category}', 'destroy')->name('delete_category');
});

Route::controller(App\Http\Controllers\CommentsController::class)->group(function() {
    Route::post('/comment/new','store')->name('new_comment');
    Route::post('profile/comment/new','profileStore')->name('new_profile_comment');
    Route::delete('/comment/delete/{comments}','destroy')->name('delete_comment');
    Route::patch('/comment/update/{comments}','update')->name('update_comment');
    // Route::get('/comment', 'index')->name('get_comment');
});

Route::controller(App\Http\Controllers\ComplaintController::class)->group(function() {
    Route::get('/complaint', 'index')->name('complaints');
    Route::post('/complaint/new', 'store')->name('new_complaint');
    Route::delete('/complaint/delete/{complaint}', 'destroy')->name('delete_complaint');
});



Route::controller(App\Http\Controllers\Auth\AuthenticatedSessionController::class)->group(function() {
    Route::get('login/yandex', 'yandex')->name('yandex');
    Route::get('login/yandex/redirect', 'yandexRedirect')->name('yandexRedirect');
});

require __DIR__.'/auth.php';