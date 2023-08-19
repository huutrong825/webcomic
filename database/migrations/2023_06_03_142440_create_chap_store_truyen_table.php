<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chap_store_truyen', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_truyen');
                $table->integer('id_viewer');
                // $table->foreignId('id_truyen')->constrained('truyen');
                // $table->foreignId('id_vieswer')->constrained('user_guests');
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chap_store_truyen');
    }
};
