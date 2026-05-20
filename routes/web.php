<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LayananController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/form', function () {
    return view('form');
});

Route::post('/guest/store', [GuestController::class, 'store']);

//ADMIN
Route::get('/admin/manajemen-tamu',
    [GuestController::class, 'index']);
Route::post('/admin/manajemen-tamu/{id}/status',
    [GuestController::class, 'updateStatus']);
Route::delete('/admin/guests/{id}',
    [GuestController::class, 'destroy']);
Route::get('/admin/dashboard',
    [GuestController::class, 'dashboard']);
Route::post('/layanan/store', [LayananController::class, 'store'])
    ->name('layanan.store');
Route::get('/admin/export-csv', [GuestController::class, 'exportCsv']);

Route::post('/survey/store', [GuestController::class, 'storeSurvey']);
    // Halaman Form Survey
Route::get('/survey', function () {
    return view('survey');
});

// Proses Simpan Survey (Menghubungkan ke fungsi yang kita buat di Controller tadi)
Route::post('/survey/store', [App\Http\Controllers\GuestController::class, 'storeSurvey']);