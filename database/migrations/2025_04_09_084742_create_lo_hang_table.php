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
        Schema::create('lo_hang', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_vattu')->nullable()->constrained('vattu');
            $table->foreignId('id_phieunhap')->nullable()->constrained('phieunhap');
            $table->integer('SoLuong_Nhap')->nullable();
            $table->decimal('DonGia_Nhap', 15, 2)->nullable();
            $table->date('NgayNhap')->nullable();
            $table->integer('SoL_Ton')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lo_hang');
    }
};
