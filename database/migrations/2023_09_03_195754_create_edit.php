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
            $table->timestamp('ngay_dang')->change();
        });

        Schema::table('chap', function (Blueprint $table) {
            $table->timestamp('ngay_dang')->change();
        });

        Schema::table('comment', function (Blueprint $table) {
            $table->timestamp('ngay_dang')->change();
            $table->integer('id_chap')->nullable()->change();
        });

        Schema::table('chap_noidung', function (Blueprint $table) {
            $table->longText('noi_dung')->change();
        });

        Schema::drop('user-guests');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
