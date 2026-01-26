<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance;
use App\Models\Maintenance_doc;
use Illuminate\Support\Facades\Storage;


class MaintenanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maintenances = Maintenance::get();
        return view('maintenance.index',['maintenances'=>$maintenances]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('maintenance.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'name' => 'required',
            'start_date' => 'required|date',

            'manager' => 'required',
            'phone' => 'nullable',
            'email' => 'nullable',
            'description' => 'required',
            'docs.*' => 'file|mimes:pdf,doc,docx,txt|max:5120'
        ]);
        $validated['center_id'] = session('center_id');
        $validated['status'] = 'active';
        $maintenance = Maintenance::create($validated);

        $files = $request->file('docs');
        if ($files) {
            foreach ($files as $file) {
                // Generar un nombre único para cada archivo
                $name_file = time() . '-' . $file->getClientOriginalName();

                // Guardar archivo en el disco 'supplementary_services' (configurado en config/filesystems.php)
                $storage_path = Storage::disk('maintenance')->putFileAs('', $file, $name_file);

                // Guardar registro en la tabla relacionada
                $maintenance->maintenance_docs()->create([
                    'name' => $file->getClientOriginalName(), // Nombre original del archivo
                    'path' => $storage_path,                 // Ruta de almacenamiento
                ]);
            }
        }

        return redirect()->route('maintenance.index');
            
    }

    /**
     * Display the specified resource.
     */
    public function show(Maintenance $maintenance)
    {
        return view('maintenance.show',['maintenance'=>$maintenance]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Maintenance $maintenance)
    {
        return view('maintenance.edit',['maintenance'=>$maintenance]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Maintenance $maintenance)
    {
        // Validación de los datos recibidos
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'manager' => 'required|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'description' => 'nullable|string',
        ]);

        // Actualizar los datos del mantenimiento
        $maintenance->update($validated);

        // Redirigir a la vista del mantenimiento actualizado con mensaje de éxito
        return redirect()
            ->route('maintenance.show', $maintenance)
            ->with('success', 'Manteniment actualitzat correctament.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
