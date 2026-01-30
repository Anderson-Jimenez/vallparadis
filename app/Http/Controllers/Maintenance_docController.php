<?php

namespace App\Http\Controllers;
use App\Models\Maintenance;
use App\Models\Maintenance_doc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class Maintenance_docController extends Controller
{
    public function store(Request $request, Maintenance $maintenance)
    {
        $user = Auth::user();
        if($user->role_id == 3){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
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
    }

    public function download(Maintenance_doc $document)
    {   
        $user = Auth::user();
        if($user->role_id == 3){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            return Storage::disk('maintenance')
                ->download($document->path, $document->name);
        }
    }

}
