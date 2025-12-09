<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\External_Contacts;


class External_ContactsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
        public function index(Request $request)
        {
            $query = External_Contacts::query();

            // Aplicar filtro de purpose_type si existe
            if ($request->has('purpose_type') && $request->purpose_type != '') {
                $query->where('purpose_type', $request->purpose_type);
            }

            // Aplicar filtro de origin_type si existe
            if ($request->has('origin_type') && $request->origin_type != '') {
                $query->where('origin_type', $request->origin_type);
            }

            // Ordenar
            $query->orderBy('organization');

            $external_contacts = $query->get();

            return view('management_team.external_contacts_management', [
                'external_contacts' => $external_contacts,
                'filters' => [
                    'purpose_type' => $request->purpose_type,
                    'origin_type' => $request->origin_type,
                ]
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
        //
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
    public function search(Request $request)
    {
        // 1. Validamos que haya parámetro 'q'
        if (!$request->has('q') || strlen($request->q) < 2) {
            return response()->json([]);
        }
        
        $search = $request->input('q');
        
        // 2. Creamos la consulta base
        $query = ExternalContact::query()
                    ->where(function($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%")
                        ->orWhere('organization', 'LIKE', "%{$search}%");
                    });
        
        // 3. Aplicamos filtro de purpose si existe
        if ($request->has('purpose') && $request->purpose != '') {
            $query->where('purpose_type', $request->purpose);
        }
        
        // 4. Aplicamos filtro de origin si existe
        if ($request->has('origin') && $request->origin != '') {
            $query->where('origin_type', $request->origin);
        }
        
        // 5. Ejecutamos la consulta
        $results = $query->limit(50)->get();
        
        // 6. Devolvemos los resultados
        return response()->json($results);
    }
}
