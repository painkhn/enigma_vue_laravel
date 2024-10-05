<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Theme, Category, User};
use App\Http\Requests\StoreThemeRequest;
use App\Http\Requests\UpdateThemeRequest;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Auth;

class ThemeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'themes' => Theme::get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('themes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $theme = Theme::create([
            'name' => $request->title,
            'content' => $request->content,
            'user_id' => Auth::id(),
            'category_id' => 1,
        ]);

        return response()->json($theme, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Theme $theme)
    {
        return response()->json($theme->load('user', 'category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Theme $theme)
    {
        return view('themes.edit', compact('theme'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateThemeRequest $request, Theme $theme)
    {
        $theme->update($request->validated());

        return response()->json($theme);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Theme $theme)
    {
        $theme->delete();
        
        return response()->json(['message' => 'Theme deleted successfully']);
    }
}
