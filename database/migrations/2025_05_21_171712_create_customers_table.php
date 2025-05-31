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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();       // Họ tên
            $table->string('nickname', 255)->nullable();        // Biệt danh
            $table->string('phone', 255)->nullable();           // Số điện thoại
            $table->string('address', 255)->nullable();         // Địa chỉ
            $table->boolean('status')->default(0);              // Trạng thái
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
