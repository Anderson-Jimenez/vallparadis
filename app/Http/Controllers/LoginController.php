<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        request()->validate([
            'name'=>'required',
            'passwd'=>'required'
        ]);

        //Validació sin base de datos:

        $user = $request->input('name');
        $pass = $request->input('passwd');

        if ($user === 'admin' && $pass === '1234') {
            // Si las credenciales son correctas → redirigir a /principal
            return redirect()->route('equip_directiu.principal');
        } 
        else {
            // Si son incorrectas → volver al login con mensaje de error
            return redirect()->route('login')->withErrors([
                'login' => 'Usuari o contrasenya incorrectes.'
            ]);
        }
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
}
