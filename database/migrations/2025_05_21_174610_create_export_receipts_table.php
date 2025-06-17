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
        Schema::create('export_receipts', function (Blueprint $table) {
            $table->id();
            // Foreign keys
            $table->foreignId('employee_id')->nullable()->constrained('employees');        // id_NV → employees
            $table->foreignId('warehouse_id')->nullable()->constrained('warehouses');      // id_Kho → warehouses
            $table->foreignId('customer_id')->nullable()->constrained('customers');        // id_KH → customers
            $table->date('issued_date')->nullable();                                       // NgayLap → issued_date
            $table->foreignId('payment_method_id')->nullable()->constrained('payment_methods'); // id_ptthanhtoan → payment_methods
            $table->decimal('total_amount', 15, 2)->nullable();                             // Tong_Tien → total_amount
            $table->boolean('status')->default(0);              // Trạng thái

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('export_receipts');
    }
};
