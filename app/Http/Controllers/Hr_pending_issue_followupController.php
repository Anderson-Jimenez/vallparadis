<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hr_pending_issue;
use App\Models\Hr_pending_issue_followup;
use App\Models\Hr_pending_issue_followup_document;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Hr_pending_issue_followupController extends Controller
{
    /**
     * Display followups for an HR issue
     */
    public function index(Professional $professional, Hr_pending_issue $hr_pending_issue)
    {
        $followups = $hr_pending_issue->followups()
            ->with(['professional', 'documents']) // Añadir documents aquí
            ->orderBy('followup_date', 'desc')
            ->get();
            
        return view('rrhh.followups.index', [
            'followups' => $followups,
            'hr_pending_issue' => $hr_pending_issue,
            'professional' => $professional
        ]);
    }

    /**
     * Store a new followup
     */
    public function store(Request $request, Professional $professional, Hr_pending_issue $hr_pending_issue)
    {
        $validated = $request->validate([
            'followup_date' => 'required|date',
            'description' => 'required|string',
            'documents.*' => 'nullable|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:5120'
        ]);

        // Crear el seguimiento
        $followup = Hr_pending_issue_followup::create([
            'hr_pending_issue_id' => $hr_pending_issue->id,
            'professional_id' => Auth::id(),
            'followup_date' => $validated['followup_date'],
            'description' => $validated['description'],
        ]);

        // Manejar documentos si se suben
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = Storage::disk('hr_issues')->putFileAs('followups', $file, $filename);
                
                // Usar hr_followup_id como en la migración
                $followup->documents()->create([
                    'hr_followup_id' => $followup->id, // ← CORREGIDO
                    'path' => $path,
                ]);
            }
        }

        return redirect()->route('hr_pending_issues.followups.index', [$professional, $hr_pending_issue])
            ->with('success', 'Seguiment registrat correctament');
    }

    /**
     * Download followup document
     */
    public function downloadDocument(Professional $professional, Hr_pending_issue $hr_pending_issue, $documentId)
    {
        // Buscar el documento por su ID
        $document = Hr_pending_issue_followup_document::findOrFail($documentId);
        
        // Verificar que el documento pertenece a un followup de este issue
        $followup = Hr_pending_issue_followup::find($document->hr_followup_id);
        
        if (!$followup || $followup->hr_pending_issue_id != $hr_pending_issue->id) {
            abort(403, 'Accés no autoritzat');
        }
        
        if (!Storage::disk('hr_issues')->exists($document->path)) {
            abort(404, 'Document no trobat');
        }

        return Storage::disk('hr_issues')->download($document->path);
    }
}