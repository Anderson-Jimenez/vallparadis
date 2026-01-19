<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document_center;
use App\Models\Document_center_info;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class Document_centerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $documents = Document_center_info::with('documents_center')
            ->where('center_id', session('center_id'))
            ->orderBy('created_at', 'desc')
            ->get();

        $latest_documents = Document_center::with('document_center_info')
            ->whereHas('document_center_info', function ($q) {
                $q->where('center_id', session('center_id'));
            })
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('documents.index', [
            'documents_center' => $documents,
            'latest_documents' => $latest_documents
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
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|string',
            'date' => 'required|date',
            'description' => 'required|string',
            'files.*' => 'file|max:10240',       
        ]);
        $document_info = Document_center_info::create([
            'type' => $validated['type'],
            'date' => $validated['date'],
            'description' => $validated['description'],
            'professional_id' => Auth::user()->id,
            'center_id' => session('center_id'),
        ]);

        $files = $request->file('files');
                
        if ($files) {
            foreach ($files as $file) {
                $name_file = time().'-'. $file->getClientOriginalName();
                $storage_path = Storage::disk('documents')->putFileAs('', $file, $name_file);
                $document_info->documents_center()->create([
                    'document_center_info_id' => $document_info->id,
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
    public function download(Document_center $document)
    {
        if (!Storage::disk('documents')->exists($document->path)) {
            abort(404, 'Arxiu no trobat');
        }

        $filename = preg_replace('/^\d+-/', '', basename($document->path));

        return Storage::disk('documents')->download($document->path, $filename);
    }

    public function search(Request $request)
    {
        $data = Document_center::where("path", "like", "%".$request->text."%") //buscar pel nom de l'arxiu
        ->take(5)
        ->get();
        $data = Document_center_info::where("type", "like", "%".$request->text."%") //buscar pel nom de l'arxiu
        ->orWhere("description", "like", "%".$request->text."%")
        ->take(5)
        ->get();
        $response = [
            "success"=>false,
            "message"=>"Ha hagut un error"
        ];
        if ($request->ajax()){ 
            $response = [
                "success"=>true,
                "message"=>"Consulta correcte",
                "data"=>$data
            ]; 
        }
        return response()->json($response);
    }
}
