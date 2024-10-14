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
    public function index($theme = null)
    {   
        if ($theme) {
            $themes = $theme;
        } else {
            $themes = Theme::with('category')->get();
            $users = User::all();
        }
        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'user' => Auth::user(),
            'themes' => $themes,
            'categories' => Category::get(),
            'users' => $users
        ]);
    }

    // public function profileIndex($name) {
    //     #Валидация добавь
    //     $user = User::where('name', $name)->first();
    //     return Inertia::render('Profile', [
    //         'themes' => Theme::where('user_id', $user->id)->get(),
    //         'user' => $user
    //     ]);
    // }

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
        $array_request = $request->all();
        $theme = Theme::create([
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            // 'user' => Auth::user(),
            'name' => $request->title,
            'content' => $array_request['content'],
            'user_id' => Auth::id(),
            'category_id' => $request->category_id
        ]);

        return response()->json(['redirect' => '/']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $theme = Theme::with('user', 'category')->findOrFail($id);
        return Inertia::render('ThemePage', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'theme' => $theme,
        ]);
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
        return response()->json(['redirect' => '/']);
    }

    public function search(Request $request) {
        $word = $request->word;
        $theme_search = Theme::where('name', 'like', "%{$word}%")->orderBy('id')->get();
        // return $this->index($theme=$theme_search);
        return response()->json($theme_search);
    }

    public function filterByCategory($categoryId)
    {
        $themes = Theme::where('category_id', $categoryId)->with('user', 'category')->get();
        return response()->json($themes);
    }
}
