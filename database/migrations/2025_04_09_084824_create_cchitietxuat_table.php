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
        Schema::create('cchitietxuat', function (Blueprint $table) {
            $table->id('id_phieuxuat');
            $table->foreignId('id_vattu')->nullable()->constrained('vattu');
            $table->integer('SoLuong')->nullable();
            $table->integer('Tong_Tien')->nullable();
            $table->foreignId('id_LoHang')->nullable()->constrained('lo_hang');

            $table->foreign('id_phieuxuat')->references('id')->on('phieuxuat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cchitietxuat');
    }
};
