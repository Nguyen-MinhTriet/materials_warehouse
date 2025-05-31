<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();          // Tên kho
            $table->string('address', 255)->nullable();       // Địa chỉ
            $table->string('image', 255)->nullable();         // Hình ảnh
            $table->string('longitude', 255)->nullable();     // Kinh độ
            $table->string('latitude', 255)->nullable();      // Vĩ độ
            $table->boolean('status')->nullable();            // Trạng thái
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
