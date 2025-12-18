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

            // Aplicar filtro de type si existe
            if ($request->has('type') && $request->type != '') {
                $query->where('type', $request->type);
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
        return view('management_team.contacts_add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $validated = request()->validate([
            'name'           => 'required',
            'type'           => 'required',
            'organization'   => 'required',

            'purpose_type'   => 'required',
            'origin_type'    => 'required',
            'purpose'        => 'required',

            'manager'        => 'required',
            'phone_numer'    => 'required',
            'email_address'  => 'required',
            'comments'       => 'required',
        ]);

        External_Contacts::create($validated);

        return redirect()
            ->route('external_contacts.index')
            ->with('success', 'Contacte creat correctament.');
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
        $data = External_Contacts::where("name", "like", "%".$request->text."%") //buscar per nom, email o nom de l'organització
        ->orWhere("organization", "like", "%".$request->text."%")
        ->orWhere("email_address", "like", "%".$request->text."%") 
        ->take(10)
        ->get();
        $response = [
            "success"=>false,
            "message"=>"Ha hagut un error"
        ];
        if ($request->ajax()){ 
            $response = [
                "success"=>true,
                "message"=>"Consulta correcte",
                "data"=>$data
            ]; 
        }
        return response()->json($response);
    }
}
