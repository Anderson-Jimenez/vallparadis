<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Project_comission;
use App\Models\Professional;

class Project_comissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects_comissions = Project_comission::with(['manager'])->get();
        return view('management_team.projects_comissions_management',['projects_comissions'=>$projects_comissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professionals = Professional::get();
        return view('management_team.project_comission_add',['professionals'=>$professionals]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
        'professional_manager_id' => 'required',
        'name' => 'required',
        'start_date' => 'required',
        'description' => 'required',
        'observation' => 'required',
        'type' => 'required',
        'path.*' => 'file|mimes:pdf,doc,docx,txt|max:5120',
        ]);
        //Subir proyecto
        $validated['center_id'] = session('center_id');
        $project = Project_comission::create($validated);

        //subir archivos
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

        return redirect()->route('project_comission.index');
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
