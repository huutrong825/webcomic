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
            'truyen', function (Blueprint $table) {
                $table->increments('id');
                // $table->foreignId('id_loai')->constrained('loai_truyen');
                $table->string('ten_truyen', 255);
                $table->string('tac_gia', 255);
                $table->string('nhom_dich', 255);
                $table->integer('loai_truyen');
                // $table->integer('the_loai');
                $table->integer('trang_thai');
                $table->text('mo_ta')->nullable();
                $table->string('bia_truyen', 50)->nullable();
                $table->integer('luot_thich')->nullable();
                $table->integer('luot_xem')->nullable();
                $table->integer('luot_theo_doi')->nullable();
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
        Schema::dropIfExists('truyen');
    }
};
