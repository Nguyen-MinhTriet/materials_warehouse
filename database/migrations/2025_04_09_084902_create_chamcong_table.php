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
        Schema::create('chamcong', function (Blueprint $table) {
            $table->id();

            $table->dateTime('work_date')->nullable();         // NgayLam
            $table->time('check_in')->nullable();              // GioVao
            $table->time('work_hours')->nullable();            // GioLam
            $table->time('overtime')->nullable();              // TangCa
            $table->tinyInteger('status')->nullable();         // TrangThai
            $table->foreignId('employee_id')->nullable()->constrained('employees'); // id_NV
            $table->time('check_out')->nullable();             // Gio_Ra

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chamcong');
    }
};
