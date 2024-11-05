<?php

namespace App\Http\Controllers;

use App\Models\{Like, View, Theme, Category, User, Comments};
use App\Http\Requests\StoreLikeRequest;
use App\Http\Requests\UpdateLikeRequest;
use Inertia\Inertia;
use Auth;
use Request;

class LikeController extends Controller
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
            $existingLike = Like::where('theme_id', $theme->id)
                                ->where('user_id', $user->id)
                                ->get();
            
            if ($existingLike->isEmpty()) { // Check if no existing views
                Like::create([
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
    public function show(Like $like)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLikeRequest $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Like $like)
    {
        $like->delete();
        return response()->json(['redirect' => '/']);
    }
}
