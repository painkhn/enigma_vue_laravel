<?php

namespace App\Http\Controllers;

use App\Models\{View, Theme, Category, User, Comments};
use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use Inertia\Inertia;
use Auth;

class ViewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        $user = Auth::user();
        $theme = Theme::get()->first();

        // dd($theme->id);
        
        $existingView = View::where('theme_id', $theme->id)->where('user_id', $user->id)->first();
        
        if (!$existingView) {
            View::create([
                'theme_id' => $theme->id,
                'user_id' => $user->id,
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(View $view)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateViewRequest $request, View $view)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(View $view)
    {
        //
    }
}
