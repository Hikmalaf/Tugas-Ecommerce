<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Kuotatahunan extends Migration
{
    public function up()
    {
        Schema::create('annual_quota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perusahaan_id'); // Foreign key ke kolom id di tabel perusahaan
            $table->integer('tahun');
            $table->string('nomor_penetapan');
            $table->dateTime('tanggal_penetapan');
            $table->string('file_penetapan');
            $table->string('status')->default('draft'); // Default status adalah 'draft'
            $table->string('keterangan')->nullable(); // Keterangan opsional
            $table->timestamps(); // Menyimpan waktu pembuatan dan update
            $table->unsignedBigInteger('annual_quota_id')->nullable(); // Menghubungkan ke kuota tahunan, opsional

            $table->foreign('annual_quota_id')
                ->references('id')
                ->on('annual_quota')
                ->onDelete('cascade');
                
            $table->foreign('perusahaan_id')
                ->references('id')
                ->on('perusahaan')
                ->onDelete('cascade'); // Hapus data annual_quota jika perusahaan terkait dihapus
        });
    }

    public function down()
    {
        Schema::dropIfExists('annual_quota'); // Menghapus tabel jika rollback
    }
}
