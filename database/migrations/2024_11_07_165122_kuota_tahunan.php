<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class kuotatahunan extends Migration
{
    public function up()
    {
        Schema::create('annual_quota', function (Blueprint $table) {
            $table->id();
            $table->string('perusahaan');
            $table->integer('tahun');
            $table->string('nomor_penetapan');
            $table->dateTime('tanggal_penetapan');
            $table->string('file_penetapan');
            $table->string('status')->default('draft'); // Default status adalah 'draft'
            $table->string('keterangan')->nullable(); // Keterangan opsional
            $table->timestamps(); // Menyimpan waktu pembuatan dan update
        });
    }

    public function down()
    {
        Schema::dropIfExists('annual_quota'); // Menghapus tabel jika rollback
    }
}
