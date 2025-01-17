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
        Schema::create('data_pengeluarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('laporan_id')->constrained('data_laporan');
            $table->date('tanggal');
            $table->string('catatan');
            $table->string('pengeluaran');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_pengeluarans');
    }
};
