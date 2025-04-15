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
        Schema::create('kho', function (Blueprint $table) {
            $table->id();
            $table->string('TenKho', 255)->nullable();
            $table->string('DiaChi', 255)->nullable();
            $table->string('Hinh', 255)->nullable();
            $table->string('KinhDo', 255)->nullable();
            $table->string('ViDo', 255)->nullable();
            $table->integer('Trang_Thai')->nullable(); // INTEGER
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kho');
    }
};
