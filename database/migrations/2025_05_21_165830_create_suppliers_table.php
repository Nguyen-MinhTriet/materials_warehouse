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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();             // Tên nhà cung cấp
            $table->string('country', 255)->nullable();          // Quốc gia
            $table->string('address', 255)->nullable();          // Địa chỉ
            $table->string('phone', 255)->nullable();            // Số điện thoại
            $table->string('tax_code', 255)->nullable();         // Mã số thuế
            $table->string('contact_person', 255)->nullable();   // Người liên hệ
            $table->boolean('status')->default(0);              // Trạng thái
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
