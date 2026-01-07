<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Monitoring;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Professional;



class MonitoringController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Professional $professional, Monitoring $monitoring)
    {
        $monitoring = Monitoring::where('professional_id', $professional->id)->orderBy('date', 'desc')->paginate(3);
        return view('professionals.monitorings.index',['professional'=>$professional, 'monitoring'=>$monitoring]);
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
    public function store(Request $request,Professional $professional)
    {
        $validated = $request->validate([

            'type' => 'required',
            'date' => 'required',
            'issue' => 'required',
            'comments' => 'required',
        ]);
        $validated['professional_id'] = $professional->id;

        $validated['professional_monitoring_id'] = Auth::user()->id;

        Monitoring::create($validated);
        return redirect()->route('monitoring.monitorings', $professional->id)->with('success', 'Avaluació creada correctament.');
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
