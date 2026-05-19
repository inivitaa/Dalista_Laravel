<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/form', function () {
    return view('form');
});
use App\Http\Controllers\GuestController;

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
    Route::post('/survey/store', [GuestController::class, 'storeSurvey']);
    // Halaman Form Survey
Route::get('/survey', function () {
    return view('survey');
});

// Proses Simpan Survey (Menghubungkan ke fungsi yang kita buat di Controller tadi)
Route::post('/survey/store', [App\Http\Controllers\GuestController::class, 'storeSurvey']);