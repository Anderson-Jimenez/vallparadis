<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;



// Mostrar formulario de login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Procesar login
Route::post('/', [LoginController::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/principal', function () {
        return view('management_team.principal');
    })->name('principal');

    // Afegir rutes com son les rutes de center i tal que pertanyen a vistes de management_team
});


