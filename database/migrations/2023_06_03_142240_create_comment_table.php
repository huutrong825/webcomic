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
            'comment', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_viewer');
                // $table->foreignId('id_viewer')->constrained('user_guests');
                $table->integer('id_truyen');
                $table->integer('id_chap')->nullable();
                // $table->foreignId('id_chap')->constrained('chap');
                $table->string('noi_dung', 255)->nullable();
                $table->timestamp('ngay_dang');
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
        Schema::dropIfExists('comment');
    }
};
