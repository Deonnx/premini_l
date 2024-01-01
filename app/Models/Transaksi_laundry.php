<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaksi_laundry extends Model
{
    use HasFactory;
    protected $table = 'transaksi_laundries';
    protected $fillable = ['pelanggan_id', 'jenis_laundry_id', 'tarif','tanggal_selesai', 'jumlah_kelo', 'total_bayar', 'status'];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id',);
    }

    public function jenis_laundry()
    {
        return $this->belongsTo(Jenis_laundry::class, 'jenis_laundry_id',);
    }
}
