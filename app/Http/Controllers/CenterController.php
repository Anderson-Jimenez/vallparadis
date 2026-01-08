<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Center;

class CenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $centers = Center::get();
        return view('centers.index',['centers'=>$centers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('centers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'center_name' => 'required',
            'location' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required',
        ]);
        $validated['status'] = 'active'; 
        Center::create($validated);
        return redirect()->route('center.index');
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
    public function edit(Center $center)
    {
        return view('centers.edit',['center'=>$center]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Center $center)
    {
        $validated = request()->validate([
            'center_name' => 'required',
            'location' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required',
        ]);
        $validated['status'] = 'active';
        $center->update($validated);
        return redirect()->route('center.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Center $center)
    {
        $center->delete(); // elimina el registro
        return redirect()->route('center.index');
    }

    public function activate(Center $center)
    {   
        $center->status = $center->status == 'active' ? 'inactive' : 'active';
        $center->save();
        return redirect()->route('center.index');
    }
}
