<?php

use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginUserController::class, 'login'])->name('login');
Route::post('/login', [LoginUserController::class, 'store'])->name('login.store');
Route::post('/', [LoginUserController::class, 'logout'])->name('logout');

Route::prefix('Admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('Dashboard');

});