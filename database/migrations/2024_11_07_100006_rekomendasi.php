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
        if (!Schema::hasTable('rekomendasi_ekspor')) {
            Schema::create('rekomendasi_ekspor', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('permohonan_id');
                $table->integer('jumlah_disetujui');
                $table->date('tanggal_disetujui');
                $table->timestamps();
        
                $table->foreign('permohonan_id')->references('id')->on('permohonan_ekspor');
            });
        }
    }
    
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekomendasi_ekspor');
    }
};
