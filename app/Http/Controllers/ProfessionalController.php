<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Professional;
use App\Models\Professional_doc;
use App\Models\Monitoring;
use App\Models\Recent_activity;
use App\Models\Center;
use App\Models\Rol;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\Uniform;
use App\Exports\LockerExport;
use App\Exports\Uniforms_historyExport;
use App\Exports\UniformsExport;


use Maatwebsite\Excel\Facades\Excel;

class ProfessionalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $status = $request->get('status', 'active');
        $professionals = Professional::where('status', $status)->get();

        return view('professionals.index', [
            'professionals' => $professionals,
            'status' => $status
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Roles que puede asignar el usuario (power <= usuario y > 0)
        $roles = Rol::where('center_id', $user->center_id)
                    ->where('power', '>=', $user->role->power) // ahora toma roles con menos poder
                    ->where('power', '>', 0) // opcional, para excluir "Sense Rol"
                        ->orWhere('power', 0) // incluir "Sense Rol"
                    ->get();

        return view('professionals.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = request()->validate([
            'role_id' => 'required|exists:rols,id',
            'name' => 'required',
            'surnames' => 'required',
            'username' => 'required',
            'password' => 'required',
            'phone_number' => 'required',
            'email_address' => 'required',
            'address' => 'required',
            'occupation' => 'required',
            'number_locker' => 'required',
            'clue_locker' => 'required',
            'path.*' => 'required|file|max:10240'
        ]);
        $validated['center_id'] = session('center_id');
        $validated['password'] = Hash::make($validated['password']);
        $validated['link_status'] = 'Actiu'; 
        $validated['status'] = 'active'; 
        $professional = Professional::create($validated);
        $files = $request->file('path');
        if ($files) {
            foreach ($files as $file) {
                $name = time() . '-' . $file->getClientOriginalName();

                $path = Storage::disk('professional')->putFileAs('', $file, $name);

                $professional->professional_docs()->create([
                    'type' => 'start',
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                ]);
            }
        }
        

        Recent_activity::create([
            'center_id' => session('center_id'),
            'professional_id' => Auth::user()->id,
            'type' => 'Nou professional registrat',
            'description' => Auth::user()->name." ha afegit a ".$validated['name']." al equip",
        ]);
        return redirect()->route('professional.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Professional $professional)
    {
        return view('professionals.show',['professional'=>$professional]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Professional $professional)
    {
        return view('professionals.edit',['professional'=>$professional]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Professional $professional)
    {
        $validated = request()->validate([

            'name' => 'required',
            'surnames' => 'required',
            'username' => 'required',
            'password' => 'nullable',
            'phone_number' => 'required',
            'email_address' => 'required',
            'address' => 'required',
            'occupation' => 'required',
            'number_locker' =>'required',
            'clue_locker' =>'required',
        ]);
        $validated['center_id'] = session('center_id');
        $validated['password'] = Hash::make($validated['password']);
        $validated['link_status'] = 'Actiu';
        $validated['status'] = 'active';
        $professional->update($validated);
        return redirect()->route('professional.index');
    }

    public function destroy(Professional $professional)
    {
        $professional->delete(); // elimina el registro
        return redirect()->route('professional.index');
    }
    public function activate(Professional $professional)
    {   
        $professional->status = $professional->status == 'active' ? 'inactive' : 'active';
        $professional->save();
        return back();
    }
    public function send_uniform(Professional $professional)
    {
        $currentUniform = Uniform::where('professional_id', $professional->id)
            ->latest()
            ->first();

        $lastShirtSize = Uniform::where('professional_id', $professional->id)
            ->whereNotNull('shirt_size')
            ->orderBy('created_at', 'desc')
            ->value('shirt_size');

        $lastTrousersSize = Uniform::where('professional_id', $professional->id)
            ->whereNotNull('trausers_size') // Note: tu campo se llama 'trausers_size' en la base de datos
            ->orderBy('created_at', 'desc')
            ->value('trausers_size');

        $lastShoesSize = Uniform::where('professional_id', $professional->id)
            ->whereNotNull('shoes_size')
            ->orderBy('created_at', 'desc')
            ->value('shoes_size');
        // Obtener historial de uniformes
        $uniformHistory = Uniform::where('professional_id', $professional->id)
            ->orderBy('renovation_date', 'desc')
            ->get();

        return view('professionals.uniform', [
            'professional' => $professional,
            'currentUniform' => $currentUniform,
            'lastShirtSize' => $lastShirtSize,
            'lastTrousersSize' => $lastTrousersSize,
            'lastShoesSize' => $lastShoesSize,
            'uniformHistory' => $uniformHistory
        ]);
    }
    public function uniform(Request $request, Professional $professional)
    {
        $validated = request()->validate([

            'shirt_size' => 'nullable',
            'trausers_size' => 'nullable',
            'shoes_size' => 'nullable',
            'renovation_date' => 'required',
        ]);
        
        $validated['professional_id'] = $professional->id; 
        $file = $request->file('docs_route');
        if ($file) {
            
            $filename = 'uniform_' . time() . '_' . $professional->id . '.' . $file->getClientOriginalExtension();
            $path = Storage::disk('uniforms')->putFileAs('', $file, $filename);
            $validated['docs_route'] = $path;
            $validated['original_filename'] = $file->getClientOriginalName();
            
        }
        
        Uniform::create($validated);
        Recent_activity::create([
            'center_id' => session('center_id'),
            'professional_id' => Auth::user()->id,
            'type' => 'Uniforme afegit/renovat',
            'description' => Auth::user()->name." ha afegit/renovar uniforme a ".$professional->name.".",
        ]);
        return redirect()->route('professional.send_uniform', $professional);
    }
    public function downloadUniformDocument(Professional $professional, Uniform $uniform)
    {
        // Verificar permisos
        if ($uniform->professional_id != $professional->id) {
            abort(403, 'No tens permisos per descarregar aquest document.');
        }

        if (!Storage::disk('uniforms')->exists($uniform->docs_route)) {
            abort(404, 'El document no existeix.');
        }

        $downloadName = $uniform->original_filename ?? 
                       "uniform_{$professional->name}_{$uniform->renovation_date}.pdf";

        return Storage::disk('uniforms')->download($uniform->docs_route, $downloadName);
    }
    public function exportar_excel_locker()
    {
        return Excel::download(new LockerExport, 'locker.xlsx');
    }
    public function exportar_excel_uniforms_history()
    {
        return Excel::download(new Uniforms_historyExport, 'uniforms_history.xlsx');
    }
    public function exportar_excel_uniforms()
    {
        return Excel::download(new UniformsExport, 'uniforms.xlsx');
    }
    public function storeDocuments(Request $request, Professional $professional)
    {
        $request->validate([
            'documents.*' => 'required|file|max:10240',
        ]);

        $files = $request->file('documents');
        
        if ($files) {
            foreach ($files as $file) {
                $name = time() . '-' . $file->getClientOriginalName();
                $path = Storage::disk('professional')->putFileAs('', $file, $name);

                $professional->professional_docs()->create([
                    'type' => 'generated',
                    'name' => $file->getClientOriginalName(),
                    'path' => $path,
                ]);
            }

            Recent_activity::create([
                'center_id' => session('center_id'),
                'professional_id' => Auth::user()->id,
                'type' => 'Documents actualitzats',
                'description' => Auth::user()->name." ha pujat documents per a ".$professional->name,
            ]);

            return redirect()->route('professional.show', $professional)
                ->with('success', 'Documents pujats correctament.');
        }

        return redirect()->route('professional.show', $professional)
            ->with('error', 'No s\'han pujat documents.');
    }

    /**
     * Download a professional document
     */
    public function downloadDocument(Professional $professional, Professional_doc $document)
    {
        // Verify the document belongs to the professional
        if ($document->professional_id != $professional->id) {
            abort(403, 'No tens permisos per descarregar aquest document.');
        }

        $filePath = Storage::disk('professional')->path($document->path);
        
        if (!Storage::disk('professional')->exists($document->path)) {
            abort(404, 'El document no existeix.');
        }

        return Storage::disk('professional')->download($document->path, $document->name);
    }

    
    
    
}
