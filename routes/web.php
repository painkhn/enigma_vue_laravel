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
    Route::post('theme/new',  'store')->name('new_theme');
    
});

Route::controller(App\Http\Controllers\ProfileController::class)->group(function() {
    Route::middleware('auth')->group(function () {
        Route::get('/users/{name}', 'profileIndex')->name('profile');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::patch('/profile/update',  'update')->name('profile.update');
        Route::delete('/profile/destroy', 'destroy')->name('profile.destroy');
    });
});


require __DIR__.'/auth.php';