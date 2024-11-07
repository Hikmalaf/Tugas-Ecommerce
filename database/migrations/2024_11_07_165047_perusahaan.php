<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Perusahaan extends Migration
{
    public function up()
    {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id(); // ID perusahaan
            $table->string('kode_perusahaan');       // Kode perusahaan
            $table->string('nama_perusahaan');       // Nama perusahaan
            $table->string('kota');                  // Kota
            $table->string('jenis');                 // Jenis/tipe perusahaan
            $table->string('provinsi');              // Provinsi
            $table->string('email')->unique();       // Email perusahaan
            $table->string('nomor_telepon');         // Nomor telepon perusahaan
            $table->string('kontak_person');         // Nama kontak person
            $table->string('nomor_telepon_seluler'); // Nomor telepon kontak person
            $table->string('gambar')->nullable();    // Gambar perusahaan (misal logo)
            $table->text('alamat');                  // Alamat perusahaan
            $table->timestamps();                   // Waktu pembuatan dan update
        });
    }

    public function down()
    {
        Schema::dropIfExists('perusahaan');
    }
}
