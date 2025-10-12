<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\Project_comissionController;


// Mostrar formulari de login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Processar login
Route::post('/', [LoginController::class, 'login'])->name('login.submit');

// Sortir de la sessio Autenficat
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware(['auth'])->group(function () {
    Route::get('/principal', function () {
        return view('management_team.principal');
    })->name('principal');

    // Afegir rutes com son les rutes de center i tal que pertanyen a vistes de management_team
});


Route::get('/principal', function () {
    return view('management_team.principal');
})->name('principal');

//Route::post('/centers_management', [CenterController::class, 'create'])->name('center.create');

Route::get('/centers_management', function () {
    return view('management_team.centers_management');
})->name('center');

//Route::post('/professionals_management', [ProfessionalController::class, 'create'])->name('professional.create');

Route::get('/professionals_management', function () {
    return view('management_team.professionals_management');
})->name('professional');


//Route::post('/projects_comissions_management', [Project_comissionController::class, 'create'])->name('project_comission.create');

Route::get('/projects_comissions_management', function () {
    return view('management_team.projects_comissions_management');
})->name('project_comission');

