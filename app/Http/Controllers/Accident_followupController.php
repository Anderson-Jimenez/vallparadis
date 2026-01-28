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