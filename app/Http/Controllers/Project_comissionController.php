<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Models\Project_comission;
use App\Models\Recent_activity;
use App\Models\Project_comission_document;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;

class Project_comissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects_comissions = Project_comission::with(['manager'])->get();
        return view('projects_comissions.index',['projects_comissions'=>$projects_comissions]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professionals = Professional::get();
        return view('projects_comissions.create',['professionals'=>$professionals]);
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
            'path.*' => 'file|max:5120',
        ]);
        //Subir proyecto
        $validated['center_id'] = session('center_id');
        $validated['status'] = 'active'; 
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
        Recent_activity::create([
            'center_id' => session('center_id'),
            'professional_id' => Auth::user()->id,
            'type' => 'Projecte/Comissió afegit',
            'description' => Auth::user()->name." ha afegit un nou projecte/comissió ".$validated['name'].".",
        ]);
        return redirect()->route('project_comission.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project_comission $project_comission)
    {
        $project_comission->load([
            'manager',
            'center',
            'projects_comissions_documents'
        ]);

        return view('projects_comissions.show', compact('project_comission'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project_comission $project_comission)
    {
        $professionals = Professional::get();
        $professional_name = $project_comission->manager->name . ' ' . $project_comission->manager->surnames;
        return view('projects_comissions.edit',
        ['project_comission'=>$project_comission, 'professionals'=>$professionals, 'professional_name'=>$professional_name]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project_comission $project_comission)
    {
        $validated = $request->validate([
        'professional_manager_id' => 'required',
        'name' => 'required',
        'start_date' => 'required',
        'description' => 'required',
        'observation' => 'required',
        'type' => 'required',
        'path.*' => 'file|max:5120',
        ]);
        //Subir proyecto
        $validated['center_id'] = session('center_id');
        $validated['status'] = 'active'; 
        $project_comission->update($validated);

        //subir archivos
        $files = $request->file('path');
        if ($files) {
            foreach ($files as $file) {
                $name_file = time().'-'. $file->getClientOriginalName();
                $storage_path = Storage::disk('projects_comissions')->putFileAs('', $file, $name_file);
                $project_comission->projects_comissions_documents()->create([
                    'name' => $project_comission->name, 
                    'path' => $storage_path,  
                ]);
            }
        }

        return redirect()->route('project_comission.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project_comission $project_comission)
    {
        $project_comission->delete(); // elimina el registro
        return redirect()->route('project_comission.index');
    }

    public function activate(Project_comission $project_comission)
    {   
        $project_comission->status = $project_comission->status == 'active' ? 'inactive' : 'active';
        $project_comission->save();
        return redirect()->route('project_comission.index');
    }
    public function downloadDocument(Project_comission_document $document)
    {
        $disk = Storage::disk('projects_comissions');

        if (! $disk->exists($document->path)) {
            abort(404, 'Document no trobat');
        }

        $downloadName = preg_replace('/^\d+-/', '', basename($document->path));

        return $disk->download($document->path, $downloadName);
    }
}
