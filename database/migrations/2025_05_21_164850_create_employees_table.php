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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();            // Tên nhân viên
            $table->string('email', 155)->nullable();           // Email
            $table->string('phone', 55)->nullable();           // Số điện thoại
            $table->string('address', 255)->nullable();         // Địa chỉ
            $table->string('position', 255)->nullable();        // Chức vụ
            $table->string('contract', 255)->nullable();        // Hợp đồng lao động
            $table->boolean('gender')->default(0);          // 0: Nữ, 1: Nam
            $table->date('birth_date')->nullable();             // Ngày sinh
            $table->boolean('status')->default(0);              // Trạng thái
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
