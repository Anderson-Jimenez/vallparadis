<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\General_service;

class General_serviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = General_service::get();
        return view('management_team.general_services',['services'=>$services]);
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
    public function show(General_service $service)
    {
        //return view('management_team.general_services',['service'=>$service]);
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
    public function update(Request $request, General_service $general_service)
    {
        $validated = $request->validate([
            'manager' => 'required',
            'contact' => 'required',
            'staff' => 'required',
            'schedule' => 'required',
        ]);

        // Opcional: añadir o modificar campos adicionales si lo necesitas
        // $validated['status'] = 'active';

        // Actualizar el servicio con los datos validados
        $general_service->update($validated);

        // Redirigir a la lista de servicios o a donde quieras
        return redirect()->route('general_service.index')->with('success', 'Servicio actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
