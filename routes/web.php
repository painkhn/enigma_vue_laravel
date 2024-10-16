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
    Route::post('/search', 'search')->name('search');
    Route::get('/category/{id}', 'filterByCategory')->name('filter_by_category');
});

Route::controller(App\Http\Controllers\ProfileController::class)->group(function() {
    Route::middleware('auth')->group(function () {
        Route::get('/users/{name}', 'profileIndex')->name('profile');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::patch('/profile/update',  'update')->name('profile.update');
        Route::delete('/profile/destroy', 'destroy')->name('profile.destroy');
    });
});

Route::controller(App\Http\Controllers\CategoryController::class)->group(function() {
    Route::post('category/new', 'store')->name('new_category');
    Route::delete('/category/delete/{category}', 'destroy')->name('delete_category');
});

Route::controller(App\Http\Controllers\CommentsController::class)->group(function() {
    Route::post('/comment/new','store')->name('new_comment');
    // Route::get('/comment', 'index')->name('get_comment');
});


require __DIR__.'/auth.php';