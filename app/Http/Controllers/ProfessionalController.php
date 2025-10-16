<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Center;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //parent_table_model::with('relational_table_model')->get()
        $professionals = Professional::get();
        return view('management_team.professionals_management',['professionals'=>$professionals]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('management_team.professional_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required',
            'surnames' => 'required',
            'username' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required',
            'address' => 'required',
            'number_locker' => 'required',
            'clue_locker' => 'required',
        ]);
        $validated['center_id'] = session('center_id');
        $validated['link_status'] = 'active'; 
        Professional::create($validated);
        return redirect()->route('professional.index');
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
