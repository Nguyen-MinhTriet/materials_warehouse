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
        Schema::create('phieuxuat', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_NV')->nullable()->constrained('nhanvien');
            $table->foreignId('id_Kho')->nullable()->constrained('kho');
            $table->foreignId('id_KH')->nullable()->constrained('khachhang');
            $table->date('NgayLap')->nullable();
            $table->foreignId('id_ptthanhtoan')->nullable()->constrained('pt_thanhtoan');
            $table->decimal('Tong_Tien', 15, 2)->nullable();
            $table->integer('Trang_Thai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phieuxuat');
    }
};
