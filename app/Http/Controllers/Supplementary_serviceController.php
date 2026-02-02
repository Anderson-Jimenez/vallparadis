<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Supplementary_service;

class Supplementary_serviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $supp_services = Supplementary_service::get();
        return view('services.support.index',['supp_services'=>$supp_services]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('services.support.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'manager' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'docs.*' => 'file|mimes:pdf,doc,docx,txt|max:5120', // validación de archivos
            'comments' => 'required|string',
        ]);
        $validated['status'] = 'active';
        // Agregar el center_id desde la sesión
        $validated['center_id'] = session('center_id');

        // Crear el registro principal
        $supp_service = Supplementary_service::create($validated);

        // Subir los archivos si existen
        $files = $request->file('docs');
        if ($files) {
            foreach ($files as $file) {
                // Generar un nombre único para cada archivo
                $name_file = time() . '-' . $file->getClientOriginalName();

                // Guardar archivo en el disco 'supplementary_services' (configurado en config/filesystems.php)
                $storage_path = Storage::disk('supplementary_services')->putFileAs('', $file, $name_file);

                // Guardar registro en la tabla relacionada
                $supp_service->supplementary_service_doc()->create([
                    'name' => $file->getClientOriginalName(), // Nombre original del archivo
                    'path' => $storage_path,                 // Ruta de almacenamiento
                ]);
            }
        }

        // Redirigir a la lista de servicios
        return redirect()->route('supplementary_service.index')
                        ->with('success', 'Servicio suplementario creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(General_service $service)
    {
        return view('services.support.index',['service'=>$service]);
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
    public function update(Request $request, Supplementary_service $supplementary_service)
    {
        $validated = $request->validate([
            'type' => 'required|string|max:255',
            'start_date' => 'required|date',
            'manager' => 'required|string|max:255',
            'email_address' => 'required|email|max:255',
            'phone_number' => 'required|string|max:20',
            'comments' => 'required|string',
        ]);

        // Opcional: añadir o modificar campos adicionales si lo necesitas
        //$validated['status'] = 'active';

        // Actualizar el servicio con los datos validados
        $supplementary_service->update($validated);

        // Redirigir a la lista de servicios o a donde quieras
        return redirect()->route('supplementary_service.index')->with('success', 'Servicio actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
