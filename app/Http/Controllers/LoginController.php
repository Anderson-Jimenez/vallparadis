<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Professional;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // Buscar al profesional en la base de datos
        $professional = Professional::where('username', $credentials['username'])->first();

        // verificacio de si existeix un profesional amb el nom indicat i la contrasenya del mateix existeix
        if ($professional && Hash::check($credentials['password'], $professional->password)) {
            session(['center_id' => $professional->center_id]);
            Auth::login($professional); // Comanda per
            return redirect()->route('dashboard');
        }
        return back()->withErrors([
            'login' => 'Email o contraseña incorrectos.',
        ]);
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
