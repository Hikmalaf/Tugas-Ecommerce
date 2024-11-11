<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailKuotaController;
use App\Http\Controllers\KuotaTahunanController;
use App\Http\Controllers\PermohonanEksporController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Rute utama menuju halaman login
Route::get('/', function () {
    return view('auth.login'); // Tidak perlu '/' di depan 'auth.login'
});

// Rute login
Route::get('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login']);



// Rute dashboard dengan middleware autentikasi
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

// Rute untuk pengecekan koneksi database
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Koneksi ke database berhasil.";
    } catch (\Exception $e) {
        return "Koneksi ke database gagal: " . $e->getMessage();
    }
});

// Rute kuota tahunan (hanya dapat diakses setelah login)
Route::get('/kuota-tahunan', [KuotaTahunanController::class, 'index'])->middleware('auth');

// Grup rute untuk asosiasi dengan prefix dan middleware
Route::prefix('asosiasi/kuota')->middleware('auth')->group(function () {
    Route::get('detailkuota', [DetailKuotaController::class, 'index'])->name('asosiasi.kuota.index');
    Route::post('detailkuota', [DetailKuotaController::class, 'store'])->name('asosiasi.kuota.store');
    Route::get('detailkuota/{id}/edit', [DetailKuotaController::class, 'edit'])->name('asosiasi.kuota.edit');
    Route::put('detailkuota/{id}', [DetailKuotaController::class, 'update'])->name('asosiasi.kuota.update');
    Route::delete('detailkuota/{id}', [DetailKuotaController::class, 'destroy'])->name('asosiasi.kuota.destroy');
});

// Grup rute untuk perusahaan dengan prefix dan middleware
Route::prefix('perusahaan/kuota')->middleware('auth')->group(function () {
    Route::get('detailperusahaan', [DetailKuotaController::class, 'indexPerusahaan'])->name('perusahaan.kuota.indexPerusahaan');
    Route::post('permohonan', [PermohonanEksporController::class, 'storePermohonan'])->name('perusahaan.permohonan.store');
});
Route::prefix('perusahaan/permohonan')->middleware('auth')->group(function () {
    Route::get('detailperusahaan', [DetailKuotaController::class, 'indexPerusahaan'])->name('perusahaan.kuota.indexPerusahaan');
    Route::post('permohonan', [PermohonanEksporController::class, 'storePermohonan'])->name('perusahaan.permohonan.store');
});

Route::prefix('perusahaan/permohonan')->middleware('auth')->group(function () {
Route::get('/permohonan', [PermohonanEksporController::class, 'index'])->name('permohonan.index');
Route::post('/permohonan', [PermohonanEksporController::class, 'store'])->name('permohonan.store');
Route::post('/permohonan/{id}/status', [PermohonanEksporController::class, 'updateStatus'])->name('permohonan.updateStatus');
});

Route::post('/logout', function () {
    FacadesAuth::logout();
    return redirect('/');
})->name('logout');

