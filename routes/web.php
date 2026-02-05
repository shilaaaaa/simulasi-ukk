<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PeminjamanAdminController;

Route::get('/', function () {
    return view('layouts.sidebar');
});

Route::resource('/admin/inventaris', InventarisController::class);
Route::resource('peminjaman', PeminjamanController::class);
Route::resource('/admin/approval', ApprovalController::class);
Route::resource('/home', HomeController::class);
Route::resource('/admin/peminjaman', PeminjamanAdminController::class);