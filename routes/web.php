<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\GuestDetailController;
/*
|--------------------------------------------------------------------------
| PENGUNJUNG
|--------------------------------------------------------------------------
*/

Route::get('/', [GuestController::class, 'welcome']);

Route::get('/form', [GuestController::class, 'form']);

Route::post('/guest/store', [GuestController::class, 'store']);

Route::get('/survey', function () {
    return view('pengunjung.survey');
});

Route::post('/survey/store', [GuestController::class, 'storeSurvey']);

Route::get('/status', function () {
    return view('pengunjung.status');
});

Route::post('/status/check', [GuestController::class, 'checkStatus']);

Route::get('/lupa-token', function () {
    return view('pengunjung.lupa-token');
});

Route::post('/lupa-token', [GuestController::class, 'lupaToken']);


/*
|--------------------------------------------------------------------------
| LOGIN ADMIN
|--------------------------------------------------------------------------
*/

Route::get('/admin/login', function () {
    return view('admin.login');
});

Route::post('/admin/login', [GuestController::class, 'login']);

Route::get('/admin/logout', [GuestController::class, 'logout']);


/*
|--------------------------------------------------------------------------
| AREA ADMIN (WAJIB LOGIN)
|--------------------------------------------------------------------------
*/

Route::middleware('admin.auth')->group(function () {

    Route::get('/admin/dashboard',
        [GuestController::class, 'dashboard']);

    Route::get('/admin/manajemen-tamu',
        [GuestController::class, 'index']);

    Route::get('/admin/manajemen-tamu/{id}',
    [GuestDetailController::class, 'show'])
    ->name('guest.detail');

    Route::post('/admin/manajemen-tamu/{id}/status',
        [GuestController::class, 'updateStatus']);

    Route::post('/admin/manajemen-tamu/{id}/jadwal',
        [GuestDetailController::class, 'jadwalkan'])
        ->name('guest.jadwal');

    Route::post(
        '/admin/manajemen-tamu/{id}/datang',
        [GuestDetailController::class, 'datang']
    )->name('guest.datang');

    Route::delete('/admin/manajemen-tamu/{id}',
        [GuestController::class, 'destroy'])
        ->name('guest.destroy');

    Route::post('/layanan/store',
        [LayananController::class, 'store'])
        ->name('layanan.store');

    Route::delete('/admin/layanan/{id}',
        [LayananController::class, 'destroy'])
        ->name('layanan.destroy');

    Route::put('/admin/layanan/{id}',
        [LayananController::class, 'update'])
        ->name('layanan.update');

    Route::post('/bidang/store',
        [LayananController::class, 'storeBidang'])
        ->name('bidang.store');

    Route::put('/admin/bidang/{id}',
        [LayananController::class, 'updateBidang'])
        ->name('bidang.update');

    Route::delete('/admin/bidang/{id}',
        [LayananController::class, 'destroyBidang'])
        ->name('bidang.destroy');

    Route::get('/admin/export-csv',
        [GuestController::class, 'exportCsv']);

    Route::get('/admin/survey',
        [GuestController::class, 'surveyAdmin']);

    Route::get('/admin/survey/export',
        [GuestController::class, 'exportSurvey']);

    Route::get('/admin/laporan',
        [GuestController::class, 'laporanAdmin']);

    Route::get('/admin/laporan/export-pdf',
        [GuestController::class, 'exportPdf'])
        ->name('laporan.pdf');

    Route::get('/admin/profil',
        [GuestController::class, 'profil']);
    
    Route::post(
        '/admin/change-password',
        [GuestController::class, 'changePassword']
    )->name('admin.change-password');
    
});
   
