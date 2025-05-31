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
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();

            $table->date('month')->nullable();                // Tháng lương
            $table->integer('basic_salary')->nullable();      // Lương cơ bản
            $table->integer('overtime_pay')->nullable();      // Lương tăng ca
            $table->integer('total_salary')->nullable();      // Tổng lương

            $table->foreignId('employee_id')->nullable()->constrained('employees'); // id_NV

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('salaries');
    }
};
