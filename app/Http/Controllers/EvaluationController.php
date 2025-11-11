<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use App\Models\EvaluationResult;
use App\Models\Professional;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class EvaluationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Professional $professional)
    {
        $evaluations = Evaluation::where('assessed_professional_id', $professional->id)->orderBy('evaluation_date', 'asc')->paginate(3);
        return view('management_team.professionals_evaluations',['professional'=>$professional, 'evaluations'=>$evaluations]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Professional $professional,Evaluation $evaluations)
    {
        return view('management_team.evaluation_add',['professional'=>$professional, 'evaluations'=>$evaluations]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Professional $professional)
    {
        $validated = $request->validate([
            'evaluation_date' => 'required',
            'assessed_professional_id'=> 'required',
            // Validación para las preguntas (opcional)
            'q1' => 'required',
            'q2' => 'required',
            'q3' => 'required',
            'q4' => 'required',
            'q5' => 'required',
            'q6' => 'required',
            'q7' => 'required',
            'q8' => 'required',
            'q9' => 'required',
            'q10' => 'required',
            'q11' => 'required',
            'q12' => 'required',
            'q13' => 'required',
            'q14' => 'required',
            'q15' => 'required',
            'q16' => 'required',
            'q17' => 'required',
            'q18' => 'required',
            'q19' => 'required',
            'q20' => 'required',
        ]);

        $evaluation = Evaluation::create([
            'evaluator_id' => Auth::user()->id,
            'assessed_professional_id' => $validated['assessed_professional_id'],
            'evaluation_date' => $validated['evaluation_date'],
            'average_score' => $request->input('total_score'),
        ]);
        //EvaluationResult::create($validated);
        
        $evaluation->results()->create($request->only([
            'q1','q2','q3','q4','q5','q6','q7','q8','q9','q10',
            'q11','q12','q13','q14','q15','q16','q17','q18','q19','q20'
        ]));
        
        return redirect()->route('professionals.evaluations', $evaluation->assessed_professional_id)->with('success', 'Avaluació creada correctament.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Evaluation $evaluation)
    {
        $questions = [
        "Realitza una correcta atenció a l'usuari",
        "Es preocupa per satisfer les seves necessitats dins dels recursos dels que disposa",
        "S'ha integrat dins de l'equip de treball i participa i coopera sense dificultats",
        "Pot treballar amb altres equips diferents al seu si es necessita",
        "Compleix amb les funcions establertes",
        "Assolix els objectius utilitzant els recursos disponibles per aconseguir els resultats esperats",
        "És coherent amb el que diu i amb les seves actuacions",
        "Les seves actuacions van alineades amb els valors de la nostra Entitat",
        "Mostra capacitat i interès per aplicar la normativa i els procediments establerts",
        "La seva actitud envers els seus responsables/comandaments és correcta",
        "Té capacitat per comprendre i acceptar i adequar-se als canvis",
        "Desenvolupa amb autonomia les seves funcions, sense necessitat de recolzament immediat/constant",
        "Fa suggeriments i propostes de millora",
        "Assolix els objectius, esforçant-se per aconseguir el resultat esperat",
        "La quantitat de treball que desenvolupa en relació amb el temps és adequada",
        "Realitza les tasques amb la qualitat esperada i/o necessària",
        "Expressa amb claredat i ordre els aspectes rellevants de la informació",
        "Dóna el suport documental necessari per desenvolupar les tasques requerides del lloc de treball",
        "Mostra interès i motivació envers el seu lloc de treball",
        "La seva entrada i permanència en el lloc de treball es duu a terme sense retards o absències no justificades",
    ];

        return view('management_team.show_results_evaluation',['evaluation'=>$evaluation, 'questions'=>$questions]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Evaluation $evaluation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Evaluation $evaluation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Evaluation $evaluation)
    {
        //
    }
}
