<?php

namespace App\Http\Controllers;

use App\Models\{View, Theme, Category, User, Comments};
use App\Http\Requests\StoreViewRequest;
use App\Http\Requests\UpdateViewRequest;
use Inertia\Inertia;
use Auth;
use Request;

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
    public function store($id)
    {
        $user = Auth::user();
        // Assuming you want to get the first theme or a specific one
        $theme = Theme::find($id); // or Theme::find($id) if you have an ID

        if ($theme) {
            $existingView = View::where('theme_id', $theme->id)
                                ->where('user_id', $user->id)
                                ->get();
            
            if ($existingView->isEmpty()) { // Check if no existing views
                View::create([
                    'theme_id' => $theme->id,
                    'user_id' => $user->id,
                ]);
            }
        } else {
            // Handle the case where no theme is found
            // e.g., return an error response or log it
            return response()->json(['error' => 'Theme not found'], 404);
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
