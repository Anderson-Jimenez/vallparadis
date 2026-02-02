<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Project_comission;
use App\Models\Course;
use App\Models\Recent_activity;
use Illuminate\Support\Facades\Auth;
use App\Models\Document_center;
use Carbon\Carbon;

class Recent_activityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.index', [
            'professionals_count' => Professional::count(),
            'projects_count'      => Project_comission::where('status', 'active')->count(),
            'courses_count'       => Course::where('status', 'active')->count(),
            'document_count'     => Document_center::count(),

            'recent_activity' => Recent_activity::latest()->limit(10)->get(),
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
