<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;



Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/', [LoginController::class, 'store'])->name('login.store');

Route::get('/principal', function () {
    return view('management_team.principal');
})->name('principal');