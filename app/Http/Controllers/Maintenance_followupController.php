<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Maintenance_followup;
use App\Models\Maintenance_followup_doc;
use Illuminate\Http\Request;
use App\Models\Recent_activity;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class Maintenance_followupController extends Controller
{
    public function index(Maintenance $maintenance)
    {
        $user = Auth::user();
        if ($user->role_id == 3) {
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        $maintenance->load('maintenance_followups.maintenance_followup_doc', 'maintenance_followups.professional');
        $followups = $maintenance->maintenance_followups()
            ->with('maintenance_followup_doc', 'professional')
            ->orderBy('date', 'desc')
            ->get();

        return view('maintenance.followup.index', compact('maintenance', 'followups'));
    }

    public function store(Request $request, Maintenance $maintenance)
    {
        $user = Auth::user();
        if($user->role_id == 3){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            $request->validate([
                'date' => 'required|date',
                'issue' => 'required|string|max:255',
                'description' => 'required|string',
                'docs.*' => 'file|max:10240', // max 10MB
            ]);

            // Crear el seguimiento
            $followup = Maintenance_followup::create([
                'maintenance_id' => $maintenance->id,
                'professional_id' => Auth::user()->id,
                'date' => $request->date,
                'issue' => $request->issue,
                'description' => $request->description,
            ]);

            // Subir los documentos usando disco personalizado 'maintenance'
            if ($request->hasFile('docs')) {
                foreach ($request->file('docs') as $file) {
                    $filename = time() . '-' . $file->getClientOriginalName();

                    // Guardar archivo en el disco 'maintenance'
                    $path = Storage::disk('maintenance_followups')->putFileAs('', $file, $filename);

                    // Crear registro en la tabla de documentos del seguimiento
                    $followup->maintenance_followup_doc()->create([
                        'name' => $file->getClientOriginalName(),
                        'path' => $path,
                    ]);
                }
            }

            return back()->with('success', 'Seguiment creat correctament');
        }
    }

    public function show(Maintenance_followup $followup)
    {
        $user = Auth::user();
        if($user->role_id == 3){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            $followup->load('maintenance_followup_doc');

            return view('maintenance.followups.show', compact('followup'));
        }
    }
}
