<?php

namespace App\Http\Controllers;
use App\Models\Maintenance;
use App\Models\Maintenance_doc;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class Maintenance_docController extends Controller
{
    public function store(Request $request, Maintenance $maintenance)
    {
        $request->validate([
            'docs.*' => 'required|file|max:10240',
        ]);

        foreach ($request->file('docs') as $file) {
            $name = time() . '-' . $file->getClientOriginalName();

            $path = Storage::disk('maintenance')->putFileAs('', $file, $name);

            $maintenance->maintenance_docs()->create([
                'name' => $file->getClientOriginalName(),
                'path' => $path,
            ]);
        }

        return back();
    }

    public function download(Maintenance_doc $document)
    {
        return Storage::disk('maintenance')
            ->download($document->path, $document->name);
    }

}
