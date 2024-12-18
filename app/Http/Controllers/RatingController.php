<?php

namespace App\Http\Controllers;

use App\Models\{Theme, Category, User, Comments};
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class RatingController extends Controller
{
    public function index()
    {
        $users = User::all(); // Получаем всех пользователей
        $themes = Theme::with('user')->withCount('views', 'likes')->get(); // Получаем все темы вместе с пользователями

        // dd($themes);

        return Inertia::render('RatingPage', [
            'themes' => $themes,
            'users' => $users,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            // 'views_count' => $themes->views_count,
        ]);
    }

    public function sortByViews()
    {
        $users = User::all();
        $themes = Theme::with('user')->withCount('views', 'likes')->orderBy('views_count', 'desc')->get();

        return Inertia::render('RatingPage', [
            'themes' => $themes,
            'users' => $users,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            // 'views_count' => $themes->views_count,
        ]);
    }

    public function sortByLikes()
    {
        $users = User::all();
        $themes = Theme::with('user')->withCount('likes', 'views')->orderBy('likes_count', 'desc')->get();

        return Inertia::render('RatingPage', [
            'themes' => $themes,
            'users' => $users,
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            // 'views_count' => $themes->views_count,
        ]);
    }
}
