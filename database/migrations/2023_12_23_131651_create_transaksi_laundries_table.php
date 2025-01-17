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
        Schema::create('transaksi_laundries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('data_pelanggan_id')->constrained('pelanggans');
            $table->foreignId('jenis_laundry_id')->constrained('jenis_laundries');
            $table->integer('tarif');
            $table->date('tanggal_selesai');
            $table->integer('jumlah_kelo');
            $table->integer('total_bayar');
            // $table->string('catatan');
            $table->enum('status' , ['lunas','belum lunas'])->default('lunas');
            // $table->enum('status_baju' , ['sudah diambil','belum diambil'])->default('sudah diambil');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_laundries');
    }
};
