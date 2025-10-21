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
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/principal', function () {
        return view('management_team.principal');
    })->name('principal');

    // Vista administrador centers
    Route::resource('center', CenterController::class);
    Route::get('center/{center}/activate', [CenterController::class, 'activate'])->name('center.activate');

    Route::resource('professional', ProfessionalController::class);
    Route::get('professional/{professional}/activate', [ProfessionalController::class, 'activate'])->name('professional.activate');
    Route::get('professional/{professional}/send_uniform', [ProfessionalController::class, 'send_uniform'])->name('professional.send_uniform');
    Route::post('professional/{professional}/uniform', [ProfessionalController::class, 'uniform'])->name('professional.uniform');

    Route::resource('project_comission', Project_comissionController::class);
    Route::get('project_comission/{project_comission}/activate', [Project_comissionController::class, 'activate'])->name('project_comission.activate');
});
