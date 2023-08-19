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
        Schema::create('info_page', function (Blueprint $table) {
                $table->increments('id');
                $table->string('phone', 50);
                $table->string('email', 50);
                $table->string('ten_web', 50);
                $table->string('tieu_de', 50);
                $table->timestamps();
                $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('info_page');
    }
};
