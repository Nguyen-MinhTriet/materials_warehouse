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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();                    // Tên vật tư
            $table->decimal('price', 15, 2)->nullable();                // Giá
            $table->string('image', 255)->nullable();                   // Hình ảnh
            $table->string('description', 255)->nullable();             // Mô tả
            $table->date('expiration_date')->nullable();               // Hạn sử dụng
            $table->date('manufacture_date')->nullable();              // Ngày sản xuất
            $table->foreignId('category_id')->nullable()->constrained('category'); // ID danh mục
            $table->foreignId('unit_id')->nullable()->constrained('units');          // ID đơn vị tính
            $table->integer('quantity')->nullable();                   // Số lượng
            $table->string('information', 255)->nullable();            // Thông tin thêm
            $table->boolean('status')->default(0);              // Trạng thái
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
