<?php

namespace App\Http\Controllers;

use App\Models\{Complaint, Theme, Category, User, Comments};
use App\Http\Requests\StoreComplaintRequest;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateComplaintRequest;
use Inertia\Inertia;
use Auth;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::with('user')->get();
        return Inertia::render('ComplaintPage', [
            'user' => Auth::user(),
            'complaints' => $complaints,
        ]);
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
        $array_request = $request->all();
        // $theme = Theme::find($request->theme_id);
        // $comment = Comments::find($request->comments_id);
        $complaint = Complaint::create([
            // 'complaint' => $array_request['complaint'],
            'complaint' => $request->complaint,
            'user_id' => Auth::id(),
            // 'theme_id' => $theme->id,
            // 'comment_id' => $comment->id,
        ]);

        return response()->json($complaint, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateComplaintRequest $request, Complaint $complaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        //
    }
}
