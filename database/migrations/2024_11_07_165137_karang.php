<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class karang extends Migration
{public function up()
    {
        if (!Schema::hasTable('corals')) {
            Schema::create('corals', function (Blueprint $table) {
                $table->id();
                $table->string('nama'); // Nama coral
                $table->timestamps(); // Menyimpan waktu pembuatan dan update
            });
        }
    }
    

    public function down()
    {
        Schema::dropIfExists('corals'); // Menghapus tabel jika rollback
    }
}
