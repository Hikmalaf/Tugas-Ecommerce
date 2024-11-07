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
                    $table->unsignedBigInteger('coral_id');  // Menambahkan kolom coral_id
                    $table->integer('jumlah_kuota');         // Jumlah kuota
                    $table->timestamps();
    
                    // Menambahkan foreign key constraint
                    $table->foreign('coral_id')->references('id')->on('corals')->onDelete('cascade');
                });
            }
        }
    
        public function down()
        {
            Schema::dropIfExists('quota_details');
        }
    }
    