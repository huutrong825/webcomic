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
        Schema::table('info_page', function (Blueprint $table) {
            $table->string('phone', 50)->nullable()->change();
                $table->string('email', 50)->nullable()->change();
                $table->string('ten_web', 50)->nullable()->change();
                $table->string('tieu_de', 50)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('edit2');
    }
};
