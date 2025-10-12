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

    // Vista administrador centers
    Route::resource('center', CenterController::class);
    //Route::get('/centers_management', [CenterController::class, 'index'])->name('center.index');

    Route::resource('professional', CenterController::class);
    //Route::get('/professionals_management', [ProfessionalController::class, 'index'])->name('professional.index');

    Route::resource('project_comission', CenterController::class);
    //Route::get('/projects_comissions_management', [Project_comissionController::class, 'index'])->name('project_comission.index');
});




//Route::post('/centers_management', [CenterController::class, 'create'])->name('center.create');



//Route::post('/professionals_management', [ProfessionalController::class, 'create'])->name('professional.create');




//Route::post('/projects_comissions_management', [Project_comissionController::class, 'create'])->name('project_comission.create');



