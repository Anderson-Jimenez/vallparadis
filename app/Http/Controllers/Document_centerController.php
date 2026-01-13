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
        //$documents_center = Document_center::get();
        


        $documents = Document_center_info::with('documents_center_info')->where('center_id', session('center_id'))->orderBy('created_at', 'desc');
        return view('documents.index',['documents_center'=>$documents]);
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
            'files.*' => 'file|mimes:pdf,csv,docx,doc|max:10240', // 10MB máximo
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
}
