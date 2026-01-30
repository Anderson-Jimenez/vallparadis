<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Maintenance_followup_doc;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class Maintenance_followup_docController extends Controller
{
    public function download(Maintenance_followup_doc $doc)
    {
        $user = Auth::user();
        if($user->role_id == 3){
            return redirect()->route('dashboard')->with('success', 'No tens acces a questa pagina.');   
        }
        else{
            return Storage::disk('maintenance_followups')->download(
                $doc->path,
                $doc->name
            );
        }
    }
}
