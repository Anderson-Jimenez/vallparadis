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
        $professionals = Professional::with('center')->get();
        return view('management_team.professionals_management',['professionals'=>$professionals]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $centers = Center::get();
        return view('management_team.professional_add',['centers'=>$centers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate([
            'center_id' => 'required',
            'name' => 'required',
            'surnames' => 'required',
            'username' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required',
            'address' => 'required',
            'number_locker' => 'required',
            'clue_locker' => 'required',
            'link_status' => 'required',
        ]);

        Professional::create($request->all());
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
