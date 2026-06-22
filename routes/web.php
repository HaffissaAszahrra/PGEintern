<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return redirect('/mahasiswa/login');
});
Route::get('/mahasiswa/dashboard', [MahasiswaController::class, 'dashboard']);

Route::get('/mahasiswa/login', [MahasiswaController::class, 'login']);
Route::post('/mahasiswa/login', [MahasiswaController::class, 'prosesLogin']);

Route::get('/mahasiswa/absensi', [MahasiswaController::class, 'absensi']);
Route::get('/mahasiswa/riwayat', [MahasiswaController::class, 'riwayat']);

Route::get('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/rekapabsensi', [AdminController::class, 'rekapAbsensi']);
Route::get('/admin/intern_management',
    [AdminController::class, 'intern_management']);
Route::post('/admin/login',
    [AdminController::class, 'prosesLogin']);
Route::get('/admin/intern/delete/{id}',
    [AdminController::class, 'deleteIntern']);
Route::get('/admin/intern/reset/{id}',
    [AdminController::class, 'resetPassword']);
Route::post('/admin/intern/store',
    [AdminController::class, 'storeIntern']);
    Route::get('/mahasiswa/logout',
    [MahasiswaController::class, 'logout']);
    Route::post('/mahasiswa/checkin',
    [AttendanceController::class, 'checkIn']);
    Route::post('/mahasiswa/checkout',
    [AttendanceController::class, 'checkOut']);
    Route::post('/mahasiswa/izin',
    [AttendanceController::class, 'izin']);
    Route::post('/mahasiswa/sakit',
    [AttendanceController::class, 'sakit']);
    Route::get(
    '/admin/export-pdf',
    [App\Http\Controllers\AdminController::class,'exportPdf']
);