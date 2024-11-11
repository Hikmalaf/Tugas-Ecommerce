<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pengguna extends Migration
{
    public function up()
    {
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', [
                'Super Admin', 'Asosiasi', 'AKKII - Pimpinan', 'AKKII - Operator', 
                'MA - Dit. KKHSG - Pimpinan', 'MA - Dit. KKHSG - Operator', 
                'MA - KSDA - Pimpinan', 'MA - KSDA - Operator', 
                'SA - SKIKH-BRIN', 'SA - PRO-BRIN', 'Perusahaan Pimpinan', 
                'Perusahaan Operator'
            ]);
            $table->unsignedBigInteger('perusahaan_id')->nullable();  // Relasi ke tabel perusahaan
            $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}
