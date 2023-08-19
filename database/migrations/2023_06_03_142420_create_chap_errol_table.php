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
            'chap_errol', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('id_truyenloi');
                $table->integer('id_chap');
                $table->integer('id_viewer');
                // $table->foreignId('id_truyen')->constrained('truyen');
                // $table->foreignId('id_chap')->constrained('chap');
                // $table->foreignId('id_viewer')->constrained('user_guests');
                $table->string('mess_loi', 255);
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
        Schema::dropIfExists('chap_errol');
    }
};
