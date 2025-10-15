<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project_comission;

class Project_comissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects_comissions = Project_comission::with(['center', 'manager'])->get();
        return view('management_team.projects_comissions_management',['projects_comissions'=>$projects_comissions]);
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
