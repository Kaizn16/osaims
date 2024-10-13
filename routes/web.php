<?php

use App\Http\Controllers\MainPageController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\LoginUserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ViolatorController;
use Illuminate\Support\Facades\Route;

// Landing Page
Route::prefix('/')->group(function () {
    Route::get('/', [MainPageController::class, 'index'])->name('index');
    Route::get('/Registration-Guidelines', [MainPageController::class, 'regestrationGuidelines'])->name('registration.guidelines');
    Route::get('/Student/Login', [MainPageController::class, 'loginStudent'])->name('login.student');
    Route::get('/Student/Apply-Organization', [MainPageController::class, 'applyOrganization'])->name('apply.org');
});

// Auth
Route::prefix('Auth')->group(function () {
    Route::get('/', [LoginUserController::class, 'login'])->name('login');
    Route::post('/Login/User', [LoginUserController::class, 'store'])->name('login.store');
    Route::post('/Logout/User', [LoginUserController::class, 'logout'])->name('logout');
});

// Admin
Route::prefix('Admin')->middleware(['auth', 'admin'])->group(function () {

    Route::get('Dashboard', [DashboardController::class, 'index'])->name('Dashboard');

    Route::get('Users', [UserController::class, 'index'])->name('Users');
    Route::get('Users/Get', [UserController::class, 'getUsers'])->name('users.get');
    Route::get('User/New', [UserController::class, 'create'])->name('user.create');
    Route::get('/Get-Courses/{department_id}', [UserController::class, 'getCoursesByDepartment'])->name('get.courses');
    Route::post('User/Store', [UserController::class, 'store'])->name('user.store');
    Route::get('User/Edit/{user_id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('User/Update/{user_id}', [UserController::class, 'update'])->name('user.update');
    Route::delete('User/Delete/{user_id}', [UserController::class, 'destroy'])->name('user.delete');

    Route::get('Violators', [ViolatorController::class, 'index'])->name('Violators');

    Route::get('Organizations', [OrganizationController::class, 'index'])->name('Organizations');

    Route::get('Documents', [DocumentController::class, 'index'])->name('Documents');

    Route::get('Appointments', [AppointmentController::class, 'index'])->name('Appointments');

    Route::get('Settings', [SettingController::class, 'index'])->name('Settings');

});