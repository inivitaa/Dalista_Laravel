<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LayananController;

Route::get('/', function () {
    return view('pengunjung.welcome');
});
Route::get('/form', function () {
    return view('pengunjung.form');
});
Route::get('/status', function () {
    return view('pengunjung.status');
});
Route::get('/lupa-token', function () {
    return view('pengunjung.lupa-token');
});
Route::post('/lupa-token', [GuestController::class, 'lupaToken']);
Route::post('/status/check', [GuestController::class, 'checkStatus']);
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
Route::get('/admin/survey', [GuestController::class, 'surveyAdmin']);
Route::get(
    '/admin/survey/export',
    [GuestController::class, 'exportSurvey']
);

Route::post('/survey/store', [GuestController::class, 'storeSurvey']);
    // Halaman Form Survey
Route::get('/survey', function () {
    return view('pengunjung.survey');
});

// Proses Simpan Survey (Menghubungkan ke fungsi yang kita buat di Controller tadi)
Route::post('/survey/store', [App\Http\Controllers\GuestController::class, 'storeSurvey']);