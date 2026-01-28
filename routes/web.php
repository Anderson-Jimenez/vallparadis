<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CenterController;
use App\Http\Controllers\ProfessionalController;
use App\Http\Controllers\Project_comissionController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\MonitoringController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\General_serviceController;
use App\Http\Controllers\General_service_followupController;
use App\Http\Controllers\Supplementary_serviceController;
use App\Http\Controllers\Supplementary_service_followupController;
use App\Http\Controllers\External_ContactsController;
use App\Http\Controllers\Document_centerController;
use App\Http\Controllers\MaintenanceController;
use App\Http\Controllers\Hr_pending_issueController;
use App\Http\Controllers\Maintenance_docController;
use App\Http\Controllers\Maintenance_followupController;
use App\Http\Controllers\Maintenance_followup_docController;
use App\Http\Controllers\Recent_activityController;
use App\Http\Controllers\AccidentsController;






// Mostrar formulari de login
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');

// Processar login
Route::post('/', [LoginController::class, 'login'])->name('login.submit');

// Sortir de la sessio Autenficat
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');



Route::middleware(['auth'])->group(function () {
    Route::resource('recent_activity', Recent_activity::class);
    Route::get('/dashboard', [Recent_activityController::class, 'index'])
    ->name('dashboard');

    // Vista administrador centers
    Route::resource('center', CenterController::class);
    Route::get('center/{center}/activate', [CenterController::class, 'activate'])->name('center.activate');

    //Professionals
    Route::resource('professional', ProfessionalController::class);
    Route::get('professional/{professional}/activate', [ProfessionalController::class, 'activate'])->name('professional.activate');
    Route::get('professional/{professional}/send_uniform', [ProfessionalController::class, 'send_uniform'])->name('professional.send_uniform');
    Route::post('professional/{professional}/uniform', [ProfessionalController::class, 'uniform'])->name('professional.uniform');

    Route::get('/professionals', [ProfessionalController::class, 'index'])->name('professionals.index');
    Route::get('/professionals/search', [ProfessionalController::class, 'search'])->name('professionals.search');

    //Monitoring
    //Route::resource('monitoring', MonitoringController::class);
    Route::get('/monitoring/professional/{professional}', [MonitoringController::class, 'index'])
    ->name('monitoring.monitorings');   
    Route::post('/monitoring/{professional}', [MonitoringController::class, 'store'])->name('monitoring.store');

    
    //Evaluations
    Route::resource('evaluations', EvaluationController::class);
    Route::get('/professionals/{professional}/evaluations', [EvaluationController::class, 'index'])->name('professionals.evaluations');  
    Route::get('/evaluations/create/{professional}', [EvaluationController::class, 'create'])->name('evaluations.create_evaluations');

    Route::get('/evaluations/{evaluation}', [EvaluationController::class, 'show'])->name('evaluations.show_results_evaluation');

    //Projectes i comissions
    Route::resource('project_comission', Project_comissionController::class);
    Route::get('project_comission/{project_comission}/activate', [Project_comissionController::class, 'activate'])->name('project_comission.activate');
    Route::get('/project-comission/documents/{document}/download', [Project_comissionController::class, 'downloadDocument'])->name('project_comission.documents.download');

    // Document Center
    Route::resource('documents_center', Document_centerController::class);
    Route::get('documents_center/{documents_center}/activate', [Document_centerController::class, 'activate'])->name('documents_center.activate');
    Route::get('/documents-center/download/{document}', [Document_centerController::class, 'download'])
    ->name('documents_center.download');
    Route::post('/search-documents', [Document_center::class, 'search'])->name('search.documents');


    //Excels
    Route::get('/professionals/exportar-locker', [ProfessionalController::class, 'exportar_excel_locker'])->name('professionals.exportar-locker');
    Route::get('/professionals/exportar-historial-uniforms', [ProfessionalController::class, 'exportar_excel_uniforms_history'])->name('professionals.exportar-historial-uniforms');
    Route::get('/professionals/exportar-uniforms', [ProfessionalController::class, 'exportar_excel_uniforms'])->name('professionals.exportar-uniforms');
    Route::get('/courses/export-excel', [CourseController::class, 'export_excel'])->name('courses.export_excel');

    Route::resource('course', CourseController::class);
    Route::get('course/{course}/activate', [CourseController::class, 'activate'])->name('course.activate');
    Route::get('course/{course}/assign_professional', [CourseController::class, 'assign_professional'])->name('course.assign_professional');
    Route::post('/assign_professional_to_course', [CourseController::class, 'assign_professional_to_course'])->name('course.assign_professional_to_course');


    Route::resource('general_service', General_serviceController::class);
    
    Route::get('general_service/{general_service}/followups', [General_service_followupController::class, 'index'])
        ->name('general_service_followup.index');
    Route::post('general_service/{general_service}/followups', [General_service_followupController::class, 'store'])
        ->name('general_service_followup.store');
    
    Route::resource('supplementary_service', Supplementary_serviceController::class);
    
    Route::get(
        'supplementary_service/{supplementary_service}/followups',
        [Supplementary_service_followupController::class, 'index']
    )->name('supplementary_service_followup.index');

    Route::post(
        'supplementary_service/{supplementary_service}/followups',
        [Supplementary_service_followupController::class, 'store']
    )->name('supplementary_service_followup.store');

    Route::resource('external_contacts', External_ContactsController::class);
    Route::post('/search-contacts', [External_ContactsController::class, 'search'])->name('search.contacts');

    Route::resource('maintenance', MaintenanceController::class);
    Route::post(
        '/maintenance/{maintenance}/documents',
        [Maintenance_docController::class, 'store']
    )->name('maintenance.documents.store');

    Route::get(
        '/maintenance/documents/{document}/download',
        [Maintenance_docController::class, 'download']
    )->name('maintenance.documents.download');

    Route::get(
        '/maintenance/{maintenance}/followups',
        [Maintenance_followupController::class, 'index']
    )->name('maintenance.followups.index');

    // Crear seguimiento
    Route::post(
        '/maintenance/{maintenance}/followup',
        [Maintenance_followupController::class, 'store']
    )->name('maintenance.followup.store');

    // Ver seguimiento (opcional)
    Route::get(
        '/maintenance-followup/{followup}',
        [Maintenance_followupController::class, 'show']
    )->name('maintenance.followup.show');

    // Descargar documento del seguimiento
    Route::get(
        '/maintenance-followup-doc/{doc}/download',
        [Maintenance_followup_docController::class, 'download']
    )->name('maintenance.followup.doc.download');
    
    // Recursos RRHH - Temes Pendents
    Route::resource('hr_pending_issue', Hr_pending_issueController::class);

    Route::resource('accidents', AccidentsController::class);
    Route::get('/professionals/{professional}/accidents', [AccidentsController::class, 'index'])->name('professionals.accidents.index');

});
