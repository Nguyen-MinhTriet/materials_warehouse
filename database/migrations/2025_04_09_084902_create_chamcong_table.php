<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('chamcong', function (Blueprint $table) {
            $table->id();
            $table->dateTime('NgayLam')->nullable();
            $table->time('GioVao')->nullable();
            $table->time('GioLam')->nullable();
            $table->time('TangCa')->nullable();
            $table->tinyInteger('TrangThai')->nullable();
            $table->foreignId('id_NV')->nullable()->constrained('nhanvien');
            $table->time('Gio_Ra')->nullable();
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
