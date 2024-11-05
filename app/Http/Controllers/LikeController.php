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
    public function store($theme_id)
    {
        $user = Auth::user();
        $theme = Theme::find($theme_id);

        if (!$theme) {
            return response()->json(['error' => 'Theme not found'], 404);
        }

        // Check if the user has already liked this theme
        $existingLike = Like::where('theme_id', $theme->id)
                            ->where('user_id', $user->id)
                            ->first();

        if ($existingLike) {
            // User has already liked, so remove the like
            $existingLike->delete();
            $liked = false; // Set liked to false
        } else {
            // User has not liked yet, so add a new like
            Like::create([
                'theme_id' => $theme->id,
                'user_id' => $user->id,
            ]);
            $liked = true; // Set liked to true
        }

        // Return the updated likes count
        return response()->json([
            'liked' => $liked,
            'likes_count' => $theme->likes()->count(),
        ]);
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
