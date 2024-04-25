<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\KategoriController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PelangganDataController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\PenyewaanDetailController;
use App\Http\Controllers\AlatController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/pelanggan', PelangganController::class);

Route::apiResource('/admin', AdminController::class);

Route::apiResource('/alat', AlatController::class);

Route::apiResource('/kategori', KategoriController::class);

Route::apiResource('/pelanggan_data', PelangganDataController::class);

Route::apiResource('/penyewaan', PenyewaanController::class);

Route::apiResource('/penyewaan_detail', PenyewaanDetailController::class);