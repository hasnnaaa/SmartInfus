<?php

use App\Http\Controllers\Web\DashboardController;
use App\Http\Controllers\Web\AuthController; // Tambahkan ini
use App\Http\Controllers\Web\DeviceController; // Nanti kita buat ini
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::get('/', function () { return redirect('/monitoring'); });

    // Monitoring
    Route::get('/monitoring', [DashboardController::class, 'index'])->name('monitoring.index');
    Route::get('/monitoring/{device_code}', [DashboardController::class, 'detail'])->name('monitoring.detail');
    
    // Manajemen Alat (Fase 2)
    Route::get('/devices', [DeviceController::class, 'index'])->name('devices.index');
    Route::get('/devices/create', [DeviceController::class, 'create'])->name('devices.create');
    Route::post('/devices', [DeviceController::class, 'store'])->name('devices.store');
});