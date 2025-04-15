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
        Schema::create('phieunhap', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_NV')->nullable()->constrained('nhanvien');
            $table->foreignId('id_kho')->nullable()->constrained('kho');
            $table->foreignId('id_NCC')->nullable()->constrained('nhacc');
            $table->date('NgayLap')->nullable();
            $table->integer('TrangThai')->nullable();
            $table->decimal('Tong_Tien', 15, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieunhap');
    }
};
