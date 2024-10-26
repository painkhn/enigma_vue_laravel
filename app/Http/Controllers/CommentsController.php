<?php

namespace App\Http\Controllers;

use App\Models\{Theme, Category, User, Comments};
use Illuminate\Http\Request;
use App\Http\Requests\StoreCommentsRequest;
use App\Http\Requests\UpdateCommentsRequest;
use Auth;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comments = Comments::all();
        return response()->json($comments);
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
    public function store(request $request)
    {
        // dd($request);
        $array_request = $request->all();
        // $theme = Theme::first($request->theme_id);
        $theme = Theme::find($request->theme_id);
        // dd($theme);
        $comment = Comments::create([
            'content' => $array_request['content'],
            'user_id' => Auth::id(),
            'theme_id' => $theme->id
        ]);

        return response()->json(['redirect' => '/']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comments $comments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $comment)
    {
        $request->validate([
            'content' => 'required',
        ]);
        $comment = Comments::where('id', $comment)->update([
            'content' => $request->content,
        ]);

        return response()->json($comment);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comments)
    {
        $comments->delete();
        return response()->json(['redirect' => '/']);
    }
}
