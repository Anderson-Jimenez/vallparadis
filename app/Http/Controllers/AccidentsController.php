<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Professional;
use App\Models\Accident;
use Illuminate\Support\Facades\Auth;
use App\Models\Accident_doc;
use App\Models\Recent_activity;
use Illuminate\Support\Facades\Storage;

class AccidentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Professional $professional)
    {
        $accidents = Accident::with(['affected_professional', 'registred_professional'])
                        ->where('affected_professional_id', $professional->id)
                        ->orderBy('created_at', 'desc') // <-- último primero
                        ->get();

        return view('professionals.accidents.index', [
            'accidents' => $accidents,
            'professional' => $professional
        ]);
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
    public function store(Request $request, Professional $professional)
    {
        $validated = $request->validate([
            'issue' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'description' => 'required|string|max:255',
        ]);

        $endDate = $validated['end_date'] ?? null;

        // Status automático
        $status = 'active';
        if ($endDate && strtotime($endDate) <= time()) {
            $status = 'inactive';
        }

        Accident::create([
            'issue' => $validated['issue'],
            'start_date' => $validated['start_date'],
            'end_date' => $endDate,
            'description' => $validated['description'],
            'status' => $status,

            'affected_professional_id' => $professional->id,
            'registred_professional_id' => Auth::user()->id,
        ]);

        Recent_activity::create([
            'center_id' => session('center_id'),
            'professional_id' => Auth::user()->id,
            'type' => 'Professional de baixa',
            'description' => Auth::user()->name." ha posat de baixa a ".$professional->name.".",
        ]);

        return redirect()
            ->route('professionals.accidents.index', $professional)
            ->with('success', 'Accident registrat correctament');
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

    public function storeDocument(Request $request, Accident $accident)
    {
        $request->validate([
            'document' => 'required|file|max:10240',
        ]);

        $file = $request->file('document');
        $name = time() . '-' . $file->getClientOriginalName();

        $path = Storage::disk('accident')->putFileAs('', $file, $name);

        $accident->accident_doc()->create([
            'name' => $file->getClientOriginalName(),
            'path' => $path,
        ]);

        return back()->with('success', 'Fitxa pujada correctament');
    }

    /**
     * Download a document
     */
    public function downloadDocument(Accident_doc $document)
    {
        return Storage::disk('accident')
            ->download($document->path, $document->name);
    }

    public function downloadTemplate()
    {
        $templatePath = 'templates/Fitxa_Accident_Blanc.pdf';
        
        if (!Storage::disk('accident')->exists($templatePath)) {
            // Si no existe el archivo, puedes crearlo o mostrar error
            return back()->with('error', 'La plantilla no está disponible');
        }
        
        return Storage::disk('accident')
            ->download($templatePath, 'Fitxa_Accident_Blanc.pdf');
    }
}
