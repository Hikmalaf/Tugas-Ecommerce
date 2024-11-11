<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PermohonanEksporDetail extends Migration
{
    public function up()
    {
        Schema::create('detail_permohonan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permohonan_ekspor_id');
            $table->unsignedBigInteger('coral_id');
            $table->integer('jumlah');
            $table->timestamps();
        
            $table->foreign('permohonan_ekspor_id')->references('id')->on('permohonan_ekspor')->onDelete('cascade');
            $table->foreign('coral_id')->references('id')->on('corals')->onDelete('cascade');
        });
        
    }

    public function down()
    {
        Schema::dropIfExists('permohonan_ekspor_details');
    }
}
