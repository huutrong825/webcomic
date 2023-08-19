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
        Schema::create(
            'chap_noidung', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_chap');
                // $table->foreignId('id_chap')->constrained('chap');
                $table->text('noi_dung');
                $table->timestamps();
                $table->softDeletes();
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chap_noidung');
    }
};
