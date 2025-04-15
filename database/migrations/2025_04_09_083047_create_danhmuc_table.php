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
        Schema::create('danhmuc', function (Blueprint $table) {
            $table->id(); // INTEGER NOT NULL AUTO_INCREMENT UNIQUE, PRIMARY KEY
            $table->string('TênDanhMuc', 100); // VARCHAR(100) NOT NULL
            $table->integer('Trang_Thai')->nullable(); // INTEGER
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('danhmuc');
    }
};
