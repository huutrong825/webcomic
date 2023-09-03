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
        Schema::create('banner_list', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_truyen');
            $table->string('image', 100);
            $table->string('ten_truyen', 255);
            $table->integer('loai_banner');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banner_list');
    }
};
