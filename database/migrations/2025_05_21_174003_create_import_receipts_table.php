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
        Schema::create('import_receipts', function (Blueprint $table) {
            $table->id();

            // Foreign keys
            $table->foreignId('employee_id')->nullable()->constrained('employees'); // nhân viên
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses'); // kho
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers'); // nhà cung cấp

            // Fields
            $table->date('issued_date')->nullable(); // Ngày lập
            $table->boolean('status')->default(0);              // Trạng thái
            $table->decimal('total_amount', 15, 2)->nullable(); // Tổng tiền

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('import_receipts');
    }
};
