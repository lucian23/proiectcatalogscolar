<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClasaController;
use App\Http\Controllers\ElevController;
use App\Http\Controllers\MaterieController;
use App\Http\Controllers\ProfesorController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('clase', ClasaController::class);
    Route::resource('elevi', ElevController::class);
    Route::resource('materii', MaterieController::class);
    Route::resource('profesori', ProfesorController::class);
    Route::resource('note', NotaController::class);
    
    // Rute adiționale pentru rapoarte
    Route::get('/rapoarte/clase', [DashboardController::class, 'raportClase'])->name('rapoarte.clase');
    Route::get('/rapoarte/elevi/{elev}', [DashboardController::class, 'raportElev'])->name('rapoarte.elev');
});
