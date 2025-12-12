<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplementary_service;
use App\Models\Supplementary_service_followup;

class Supplementary_service_followupController extends Controller
{
    public function index(Supplementary_service $supplementary_service)
    {
        $followups = $supplementary_service->supplementary_service_followups;
        return view('management_team.supp_services_followups',['followups'=>$followups, 'supplementary_service'=>$supplementary_service]);
    }

    public function store(Request $request, Supplementary_service $supplementary_service)
    {
        $validated = $request->validate([
            'date'     => 'required|date',
            'issue'    => 'required',
            'comment'  => 'required',
        ]);

        $validated['supplementaries_service_id'] = $supplementary_service->id;

        Supplementary_service_followup::create($validated);

        return redirect()->route('supplementary_service_followup.index', $supplementary_service);
    }
}
