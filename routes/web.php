<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\Project_comissionController;
use App\Http\Controllers\CourseController;


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

    //Professionals
    Route::resource('professional', ProfessionalController::class);
    Route::get('professional/{professional}/activate', [ProfessionalController::class, 'activate'])->name('professional.activate');
    Route::get('professional/{professional}/send_uniform', [ProfessionalController::class, 'send_uniform'])->name('professional.send_uniform');
    Route::post('professional/{professional}/uniform', [ProfessionalController::class, 'uniform'])->name('professional.uniform');

    //Projectes i comissions
    Route::resource('project_comission', Project_comissionController::class);
    Route::get('project_comission/{project_comission}/activate', [Project_comissionController::class, 'activate'])->name('project_comission.activate');

    //Excels
    Route::get('/professionals/exportar-locker', [ProfessionalController::class, 'exportar_excel_locker'])->name('professionals.exportar-locker');
    Route::get('/professionals/exportar-historial-uniforms', [ProfessionalController::class, 'exportar_excel_uniforms_history'])->name('professionals.exportar-historial-uniforms');
    Route::get('/professionals/exportar-uniforms', [ProfessionalController::class, 'exportar_excel_uniforms'])->name('professionals.exportar-uniforms');

    Route::resource('course', CourseController::class);
    Route::get('course/{course}/activate', [CourseController::class, 'activate'])->name('course.activate');
});
