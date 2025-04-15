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
        Schema::create('chitietnhap', function (Blueprint $table) {
            $table->id('id_phieunhap');
            $table->foreignId('id_vattu')->nullable()->constrained('vattu');
            $table->integer('SoLuong')->nullable();
            $table->integer('Tong_Tien')->nullable();
            $table->foreign('id_phieunhap')->references('id')->on('phieunhap');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietnhap');
    }
};
