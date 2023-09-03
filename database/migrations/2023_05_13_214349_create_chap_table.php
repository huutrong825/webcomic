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
            'chap', function (Blueprint $table) {
                $table->increments('id');
                $table->string('ten_chap', 255);
                $table->integer('id_truyen');
                $table->timestamp('ngay_dang');
                // $table->foreignId('id_truyen')->constrained('truyen');
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
        Schema::dropIfExists('chap');
    }
};
