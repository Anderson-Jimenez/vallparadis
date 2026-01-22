<?php

namespace App\Http\Controllers;

use App\Models\Hr_pending_issue;
use App\Models\Professional;
use App\Models\Hr_pending_issue_document;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;


class Hr_pending_issueController extends Controller
{

    public function index()
    {
        $hr_pending_issues = Hr_pending_issue::with([
            'registered_by_professional',
            'affected_professional',
            'derived_to_professional',
            'documents'
        ])->orderBy('opened_at', 'desc')->get();
    
        return view('rrhh.index', compact('hr_pending_issues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Professional $professional)
    {
        $professionals = Professional::all();
        return view('rrhh.create',compact('professionals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'affected_professional_id' => 'required|exists:professionals,id',
            'derived_to_professional_id' => 'nullable|exists:professionals,id',
            'opened_at' => 'required|date',
            'context' => 'required|string',
            'status' => 'nullable|in:in_process,urgent,completed',
            'description' => 'required|string',
            'files.*' => 'file|max:10240',
        ]);
        $validated['center_id'] = session('center_id');

        $registered_by = Auth::user()->id;

        // No es pot derivar a la mateixa persona que registra l'assumpte
        if ($validated['derived_to_professional_id'] && $validated['derived_to_professional_id'] == $registered_by) {
            return back()->withErrors([
                'derived_to_professional_id' => 'No es pot derivar a la mateixa persona que registra l\'assumpte.'
            ])->withInput();
        }

        // Crear el tema pendiente
        $issue = Hr_pending_issue::create([
            'center_id' => $validated['center_id'],
            'affected_professional_id' => $validated['affected_professional_id'],
            'registered_by_professional_id' => $registered_by,
            'derived_to_professional_id' => $validated['derived_to_professional_id'],
            'opened_at' => $validated['opened_at'],
            'description' => $validated['description'],
            'context' => $validated['context'],
            'status' => $validated['status'],
        ]);

        
        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $safeName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $extension = $file->getClientOriginalExtension();
                $fileName = $safeName . '.' . $extension;

                // Guardar en disk 'hr_pending_issue' (configurado en filesystems.php)
                $storage_path = $file->storeAs('', $fileName, 'hr_pending_issue');

                // Guardar referencia en la tabla de documentos
                Hr_pending_issue_document::create([
                    'hr_pending_issue_id' => $issue->id,
                    'path' => $storage_path,
                ]);
            }
        }

        return redirect()->route('hr_pending_issue.index')
                        ->with('success', 'Tema pendent creat correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hr_pending_issue $hr_pending_issue)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hr_pending_issue $hr_pending_issue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hr_pending_issue $hr_pending_issue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hr_pending_issue $hr_pending_issue)
    {
        //
    }
}
