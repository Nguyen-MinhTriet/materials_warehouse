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
        Schema::create('batches', function (Blueprint $table) {
            $table->id();

            $table->foreignId('material_id')->nullable()->constrained('materials');           // id_vattu
            $table->foreignId('import_receipt_id')->nullable()->constrained('import_receipts'); // id_phieunhap
            $table->integer('import_quantity')->nullable();                                    // SoLuong_Nhap
            $table->decimal('import_price', 15, 2)->nullable();                                // DonGia_Nhap
            $table->date('import_date')->nullable();                                           // NgayNhap
            $table->integer('stock_quantity')->nullable();                                     // SoL_Ton

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batches');
    }
};
