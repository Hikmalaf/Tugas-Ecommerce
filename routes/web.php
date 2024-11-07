<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\DetailKuotaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/test-db', function () {
    try {
        DB::connection()->getPdo();
        return "Koneksi ke database berhasil.";
    } catch (\Exception $e) {
        return "Koneksi ke database gagal: " . $e->getMessage();
    }
});


Route::get('/detailkuota', [DetailKuotaController::class, 'index']);
// Route untuk Edit Detail Kuota
Route::get('/detailkuota/{id}/edit', [DetailKuotaController::class, 'edit'])->name('detailkuota.edit');


Route::prefix('kuota-tahunan')->name('kuota.tahunan.')->group(function() {
    // Menampilkan detail kuota
    Route::get('detail', [DetailKuotaController::class, 'index'])->name('index');
    
    // Menyimpan data detail kuota
    Route::post('create-detail', [DetailKuotaController::class, 'store'])->name('create_detail_kuota_tahunan');
    
    // Mengedit data detail kuota (untuk mendapatkan data dan menampilkan modal edit)
    Route::get('edit/{id}', [DetailKuotaController::class, 'edit'])->name('edit_detail_kuota_tahunan');
    
    // Mengupdate data detail kuota
    Route::put('update/{id}', [DetailKuotaController::class, 'update'])->name('update_detail_kuota_tahunan');
    
    // Menghapus data detail kuota
    Route::delete('delete/{id}', [DetailKuotaController::class, 'destroy'])->name('delete_detail_kuota_tahunan');
});
