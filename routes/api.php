<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\KendaraanController;
use App\Http\Controllers\Api\DaftarServiceController;
use App\Http\Controllers\Api\DataServiceController;
use App\Http\Controllers\Api\PembayaranServiceController;

Route::apiResource('pelanggan', PelangganController::class)->names('api.pelanggan');
Route::apiResource('kendaraan', KendaraanController::class)->names('api.kendaraan');
Route::apiResource('daftar-service', DaftarServiceController::class)->names('api.daftar-service');
Route::apiResource('data-service', DataServiceController::class)->names('api.data-service');
Route::apiResource('pembayaran-service', PembayaranServiceController::class)->names('api.pembayaran-service');