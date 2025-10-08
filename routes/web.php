<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
})->name('login');

Route::post('/', [LoginController::class, 'store'])->name('login.store');

Route::get('/principal', function () {
    return view('equip_directiu.principal');
})->name('principal');