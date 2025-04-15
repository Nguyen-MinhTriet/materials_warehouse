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
        Schema::create('nhanvien', function (Blueprint $table) {
            $table->id();
            $table->string('TenNV', 255)->nullable();
            $table->string('Email', 255)->nullable();
            $table->string('SDT', 255)->nullable();
            $table->string('DiaChi', 255)->nullable();
            $table->string('ChucVu', 255)->nullable();
            $table->string('HDLaoDong', 255)->nullable();
            $table->integer('Trang_Thai')->nullable(); // INTEGER
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhanvien');
    }
};
