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
        Schema::create('nhacc', function (Blueprint $table) {
            $table->id();
            $table->string('TenNhaCC', 255)->nullable();
            $table->string('QuocGia', 255)->nullable();
            $table->string('DiaChi', 255)->nullable();
            $table->string('SoDienThoai', 255)->nullable();
            $table->string('MaSoThue', 255)->nullable();
            $table->string('NgLienHe', 255)->nullable();
            $table->integer('Trang_Thai')->nullable(); // INTEGERphp artisan make:migration create_khachhang_table
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nhacc');
    }
};
