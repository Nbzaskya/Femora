<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MenstrualCycleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\DailyLogController;
use App\Http\Controllers\CycleSettingController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Halaman untuk pengguna yang belum login
Route::middleware('guest')->group(function () {
    Route::get('/register', function () {
        return view('auth.register');
    })->name('register');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register.store');

    Route::get('/login', function () {
        return view('auth.login');
    })->name('login');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login.store');
});

// Halaman khusus pengguna yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::get('/kalender', [CalendarController::class, 'index'])
    ->name('calendar.index');

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');

    Route::get('/menstruasi', [MenstrualCycleController::class, 'index'])
    ->name('menstrual.index');

    Route::post('/menstruasi', [MenstrualCycleController::class, 'store'])
    ->name('menstrual.store');

    Route::get('/menstruasi/{id}/edit', [MenstrualCycleController::class, 'edit'])
        ->name('menstrual.edit');

    Route::put('/menstruasi/{id}', [MenstrualCycleController::class, 'update'])
        ->name('menstrual.update');

    Route::delete('/menstruasi/{id}', [MenstrualCycleController::class, 'destroy'])
        ->name('menstrual.destroy');

    // Jurnal Harian
    Route::get('/jurnal', [DailyLogController::class, 'index'])
        ->name('journal.index');

    Route::post('/jurnal', [DailyLogController::class, 'store'])
        ->name('journal.store');

    Route::get('/jurnal/{id}/edit', [DailyLogController::class, 'edit'])
        ->name('journal.edit');

    Route::put('/jurnal/{id}', [DailyLogController::class, 'update'])
        ->name('journal.update');

    Route::delete('/jurnal/{id}', [DailyLogController::class, 'destroy'])
        ->name('journal.destroy');

    Route::get('/pengaturan-siklus', [CycleSettingController::class, 'index'])
    ->name('settings.cycle');

    Route::put('/pengaturan-siklus', [CycleSettingController::class, 'update'])
    ->name('settings.cycle.update');

});