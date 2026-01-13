<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document_center;
use App\Models\Document_center_info;

class Document_centerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents_center = Document_center::get();
        return view('documents.index',['documents_center'=>$documents_center]);
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
        $validated = $request->validate([
            'type' => 'required|string',
            'date' => 'required|date',
            'description' => 'required|string',
            'professional_id' => 'required|integer',
            'center_id' => 'required|integer',
            'files' => 'required|array',
            'files.*' => 'file|mimes:pdf,csv,docx,doc|max:10240', // 10MB máximo
        ]);
        $documentInfo = Document_center_info::create([
            'type' => $validated['type'],
            'date' => $validated['date'],
            'description' => $validated['description'],
            'professional_id' => $validated['professional_id'],
            'center_id' => $validated['center_id'],
        ]);
        $files = $request->file('path');
                $files = $request->file('path');
        if ($files) {
            foreach ($files as $file) {
                $name_file = time().'-'. $file->getClientOriginalName();
                $storage_path = Storage::disk('projects_comissions')->putFileAs('', $file, $name_file);
                $project->projects_comissions_documents()->create([
                    'name' => $project->name, // Nombre del proyecto como nombre del documento
                    'path' => $storage_path,  // Ruta del archivo
                ]);
            }
        }


        return redirect()->route('documents_center.index');
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
