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
        Schema::create('luong', function (Blueprint $table) {
            $table->id();
            $table->date('Thang')->nullable();
            $table->integer('LuongCoBan')->nullable();
            $table->integer('TangCa')->nullable();
            $table->integer('TongLuong')->nullable();
            $table->foreignId('id_NV')->nullable()->constrained('nhanvien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luong');
    }
};
