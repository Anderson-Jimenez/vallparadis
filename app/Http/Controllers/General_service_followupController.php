<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General_service;
use App\Models\General_service_followup;

class General_service_followupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(General_service $general_service)
    {
        
        $followups = $general_service->general_services_followups;
        return view('management_team.general_service_followup',['followups'=>$followups, 'general_service'=>$general_service]);
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
    public function store(Request $request, General_service $general_service)
    {
        $validated = $request->validate([
            'date' => 'required',
            'issue' => 'required',
            'comment' => 'required',
        ]);

        $validated['general_service_id'] = $general_service->id;
        General_service_followup::create($validated);
        return redirect()->route('general_service_followup.index', $general_service);
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
