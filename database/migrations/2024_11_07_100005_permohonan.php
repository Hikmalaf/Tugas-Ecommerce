<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('permohonan_ekspor', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('perusahaan_id');
            $table->string('nomor_permohonan')->unique();
            $table->date('tanggal_permohonan');
            $table->string('negara_tujuan');
            $table->string('file_permohonan')->nullable();
            $table->integer('jumlah_coral');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak'])->default('menunggu');
            $table->timestamps();
        
            $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permohonan_ekspor');
    }
};
