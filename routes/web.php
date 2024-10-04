<?php

use App\Http\Controllers\{ ProfileController, ThemeController, CategoryController };
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
})->name('home');

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/theme', function () {
    return Inertia::render('ThemePage', [
        'canLogin' => Route::has('theme')
    ]);
})->name('theme');

Route::get('/profile', function() {
    return Inertia::render('Profile');
})->name('profile');

Route::get('/theme/create', function() {
    return Inertia::render('ThemeCreate');
})->name('themeCreate');

require __DIR__.'/auth.php';
