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
/**
 * Controlador para gestionar los proyectos y comisiones. (HATIM Kenfaui)
 * Estan todas las gestiones como mostrar, crear, editar, 
 * actualizar y eliminar(desactivar).
 */
class Project_comissionController extends Controller
{
    /**
     * Muestra todos los proyectos y comisiones.
     * @return \Illuminate\View\View Vista con todos los proyectos y comisiones.
     */
    public function index()
    {
        $projects_comissions = Project_comission::with(['manager'])->get();
        return view('projects_comissions.index',['projects_comissions'=>$projects_comissions]);
    }

    /**
     * Muestra el formulario para crear un nuevo proyecto o comisión.
     * @return \Illuminate\View\View Vista del formulario.
     */
    public function create()
    {
        $professionals = Professional::get();
        return view('projects_comissions.create',['professionals'=>$professionals]);
    }

    /**
     * Guarda los datos de un nuevo proyecto o comisión creado en la base de datos.
     * También se pueden guardar archivos.
     * @param Request $request Datos enviados del formulario.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de proyectos y comisiones.
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
     * Muestra la información de un proyecto o comisión en detalle.
     * También se pueden guardar archivos.
     * @param Project_comission $project_comission Datos del proyecto o comisión que va a mostrar.
     * @return \Illuminate\View\View Vista con detalles del proyecto o comisión.
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
     * Muestra el formulario para editar un proyecto o comisión.
     * @param Project_comission $project_comission Proyecto o comisión para editar.
     * @return \Illuminate\View\View Vista del formulario de edición de proyecto o comisión.
     */
    public function edit(Project_comission $project_comission)
    {
        $professionals = Professional::get();
        $professional_name = $project_comission->manager->name . ' ' . $project_comission->manager->surnames;
        return view('projects_comissions.edit',
        ['project_comission'=>$project_comission, 'professionals'=>$professionals, 'professional_name'=>$professional_name]);
    }

    /**
     * Actualiza un proyecto o comisión existente.
     * También puede subir nuevos archivos.
     * @param Request $request Datos del formulario actualizado.
     * @param Project_comission $project_comission Proyecto o comisión para actualizar.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de proyectos y comisiones.
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
     * Elimina un proyecto o comisión.
     * @param Project_comission $project_comission Proyecto o comisión para eliminar.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de proyectos y comisiones.
     */
    public function destroy(Project_comission $project_comission)
    {
        $project_comission->delete(); // elimina el registro
        return redirect()->route('project_comission.index');
    }
    /**
     * Activa o desactiva un proyecto o comisión.
     * @param Project_comission $project_comission Proyecto o comisión para cambiar el estado.
     * @return \Illuminate\Http\RedirectResponse Redirige al listado de proyectos y comisiones.
     */
    public function activate(Project_comission $project_comission)
    {   
        $project_comission->status = $project_comission->status == 'active' ? 'inactive' : 'active';
        $project_comission->save();
        return redirect()->route('project_comission.index');
    }
    /**
     * Descarga un documento relacionado a un proyecto o comisión.
     * @param Project_comission_document $document Documento para descargar.
     * @return \Symfony\Component\HttpFoundation\StreamedResponse Archivo descargado.
     */
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
