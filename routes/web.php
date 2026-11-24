<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CatatanController;

Route::get('/', [BerandaController::class, 'index']);
Route::get('/halo', [HaloController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:5,1');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::middleware('auth')->prefix('catatan')->name('catatan.')->group(function () {
    Route::get('/', [CatatanController::class, 'index'])->name('index');
    Route::get('/tambah', [CatatanController::class, 'create'])->name('create');
    Route::get('/arsip', [CatatanController::class, 'arsip'])->name('arsip');
    Route::get('/export', [CatatanController::class, 'export'])->name('export');
    Route::get('/import', [CatatanController::class, 'importForm'])->name('import.form');
    Route::post('/import', [CatatanController::class, 'import'])->name('import');
    Route::post('/', [CatatanController::class, 'store'])->name('store');
    Route::get('/{catatan}', [CatatanController::class, 'show'])->name('show');
    Route::get('/{catatan}/edit', [CatatanController::class, 'edit'])->name('edit');
    Route::put('/{catatan}', [CatatanController::class, 'update'])->name('update');
    Route::delete('/{catatan}', [CatatanController::class, 'destroy'])->name('destroy');
    Route::post('/{catatan}/archive', [CatatanController::class, 'archive'])->name('archive');
    Route::post('/{catatan}/unarchive', [CatatanController::class, 'unarchive'])->name('unarchive');
});