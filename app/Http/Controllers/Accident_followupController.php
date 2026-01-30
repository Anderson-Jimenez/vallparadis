<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Accident;
use App\Models\Accident_followup;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;

class Accident_followupController extends Controller
{
    /**
     * Display followups for an accident
     */
    public function index(Professional $professional, Accident $accident)
    {
        $user = Auth::user();

        // Solo aplicar restricción si es Power 3 Y existe end_date
        if($user->role_id == 3 && $accident->end_date) {
            // Calcular diferencia entre end_date y start_date
            $startTimestamp = strtotime($accident->start_date);
            $endTimestamp = strtotime($accident->end_date);
            
            $secondsPerDay = 86400;
            $durationDays = ($endTimestamp - $startTimestamp) / $secondsPerDay;
            
            // Si la duración total es mayor a 30 días, bloquear
            if ($durationDays > 30) {
                return redirect()->route('professionals.accidents.index', $professional)
                    ->with('error', "No pots veure seguiments d'accidents amb durada superior a 30 dies.");   
            }
        }
        // Si no hay end_date, NO hacer nada (permitir acceso siempre)
        
        $followups = $accident->accident_followups()
            ->with('professional')
            ->orderBy('date', 'desc')
            ->get();
            
        return view('professionals.accidents.followups.index', [
            'followups' => $followups,
            'accident' => $accident,
            'professional' => $professional
        ]);
    }

    /**
     * Store a new followup
     */
    public function store(Request $request, Professional $professional, Accident $accident)
    {
        $user = Auth::user();
        
        // Aplicar la misma restricción al crear seguimientos
        if($user->role_id == 3 && $accident->end_date) {
            $startTimestamp = strtotime($accident->start_date);
            $endTimestamp = strtotime($accident->end_date);
            
            $secondsPerDay = 86400;
            $durationDays = ($endTimestamp - $startTimestamp) / $secondsPerDay;
            
            if ($durationDays > 30) {
                return redirect()->route('professionals.accidents.index', $professional)
                    ->with('error', "No pots afegir seguiments a accidents amb durada superior a 30 dies.");   
            }
        }
        
        $validated = $request->validate([
            'date' => 'required|date',
            'issue' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Accident_followup::create([
            'accident_id' => $accident->id,
            'professional_id' => Auth::id(),
            'date' => $validated['date'],
            'issue' => $validated['issue'],
            'description' => $validated['description'],
        ]);

        return redirect()->route('professionals.accidents.followups.index', [$professional, $accident])
            ->with('success', 'Seguiment registrat correctament');
    }
}