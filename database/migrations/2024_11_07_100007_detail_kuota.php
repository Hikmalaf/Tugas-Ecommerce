<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Detailkuota extends Migration
{
    public function up()
    {
        if (!Schema::hasTable('quota_details')) {
            Schema::create('quota_details', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('coral_id');            // ID coral
                $table->unsignedBigInteger('perusahaan_id');       // ID perusahaan (pemilik kuota)
                $table->integer('jumlah_kuota');                   // Jumlah kuota coral
                $table->timestamps();
            
                // Definisikan foreign key
                $table->foreign('coral_id')->references('id')->on('corals')->onDelete('cascade');
                $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->onDelete('cascade'); // Baru
                });
            }
        }
    
        public function down()
        {
            Schema::dropIfExists('quota_details');
        }
    }
    