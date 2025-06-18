<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\HelpController;

Route::get('/', function () {
    return view('/login');
})->name('login');

Route::post("/login", [LoginController::class, 'login']);

Route::get("/dashboard", [DashboardController::class, 'view'])->middleware('auth');

Route::get("/reports", [ReportsController::class, 'view'])->middleware('auth');

Route::get('/dashboard/fetch', [DashboardController::class, 'fetchDashboardData'])->middleware('auth');

Route::post('/dashboard/save-ammonia-limit', [DashboardController::class, 'saveAmmoniaLimit'])->name('save.ammonia.limit');

Route::post('/dashboard/update-mode', [DashboardController::class, 'updateMode']);

Route::get("/help", [HelpController::class, 'view'])->middleware('auth');
