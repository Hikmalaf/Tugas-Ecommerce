<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Perusahaan extends Migration
{
    public function up()
    {
        Schema::create('perusahaan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_perusahaan');
            $table->string('nama_perusahaan');
            $table->string('kota');
            $table->string('jenis');
            $table->string('provinsi');
            $table->string('email')->unique();
            $table->string('nomor_telepon');
            $table->string('kontak_person');
            $table->string('nomor_telepon_seluler')->nullable();
            $table->string('gambar')->nullable();
            $table->text('alamat')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('perusahaan');
    }
}
