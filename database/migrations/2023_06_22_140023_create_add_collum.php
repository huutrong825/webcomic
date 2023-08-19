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
        Schema::table('truyen', function (Blueprint $table) {
            //
            $table->string('nhom_dich', 255)->after('tac_gia');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('truyen', function (Blueprint $table) {
            //
            $table->dropColumn('nhom_dich', 255);
        });
    }
};
