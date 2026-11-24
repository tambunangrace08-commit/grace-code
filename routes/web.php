<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\HaloController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\CatatanController;

Route::get('/catatan', [CatatanController::class, 'index']);
Route::post('/catatan', [CatatanController::class, 'store']);
Route::get('/', [BerandaController::class, 'index']);
Route::get('/halo', [HaloController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/catatan', [CatatanController::class, 'index']);
Route::get('/catatan/tambah', [CatatanController::class, 'create']);
Route::post('/catatan', [CatatanController::class, 'store']);