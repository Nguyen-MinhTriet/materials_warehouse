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
        Schema::create('vattu', function (Blueprint $table) {
            $table->id();
            $table->string('TenVatTu', 255)->nullable();
            $table->decimal('Gia', 15, 2)->nullable();
            $table->string('Hinh', 255)->nullable();
            $table->string('MoTa', 255)->nullable();
            $table->date('HangSD')->nullable();
            $table->date('NgaySX')->nullable();
            $table->foreignId('id_danhmuc')->nullable()->constrained('danhmuc');
            $table->foreignId('id_DVT')->nullable()->constrained('donvitinh');
            $table->integer('So_Luong')->nullable();
            $table->string('Thong_Tin', 255)->nullable();
            $table->integer('Trang_Thai')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vattu');
    }
};
