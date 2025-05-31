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
        Schema::create('export_receipt_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('export_receipt_id')->constrained('export_receipts');  // id_phieuxuat
            $table->foreignId('material_id')->nullable()->constrained('materials');  // id_vattu
            $table->integer('quantity')->nullable();                                 // SoLuong
            $table->decimal('total_price', 15, 2)->nullable();                        // Tong_Tien
            $table->foreignId('batch_id')->nullable()->constrained('batches');       // id_LoHang

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_receipt_details');
    }
};
