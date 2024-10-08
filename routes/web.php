<?php

use App\Http\Controllers\{ ProfileController, ThemeController, CategoryController };
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Models\{ Category };
use Inertia\Inertia;

Route::get('/', [ThemeController::class, 'index'])->name('index');
Route::get('/theme/{id}', [ThemeController::class, 'show'])->name('themeShow');

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

// Route::get('/profile',  function() {
//     return Inertia::render('Profile');
// })->name('profile');

Route::get('/profile', [ThemeController::class, 'profileIndex'])->name('profile');

Route::get('/theme/create', function() {
    $categories = Category::get();
    return Inertia::render('ThemeCreate', ['categories' => $categories]);
})->name('themeCreate')->middleware('auth');

Route::post('theme/new', [ThemeController::class, 'store'])->name('new_theme');

require __DIR__.'/auth.php';

