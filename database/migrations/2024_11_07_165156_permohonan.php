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
            $table->unsignedBigInteger('perusahaan');
            $table->unsignedBigInteger('karang');
            $table->integer('jumlah');
            $table->enum('status', ['menunggu', 'disetujui', 'ditolak']);
            $table->timestamps();

            $table->foreign('perusahaan')->references('id')->on('perusahaan');
            $table->foreign('karang')->references('id')->on('corals');
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
