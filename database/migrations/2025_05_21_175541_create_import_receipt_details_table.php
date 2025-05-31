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
        Schema::create('import_receipt_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('import_receipt_id')->constrained('import_receipts'); // liên kết đến bảng phiếu nhập
            $table->foreignId('material_id')->nullable()->constrained('materials'); // id_vattu
            $table->integer('quantity')->nullable();                                 // SoLuong
            $table->decimal('total_amount', 15, 2)->nullable();                      // Tong_Tien

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_receipt_details');
    }
};
