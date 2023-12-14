<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans'; //ini buat nama tabel nya

    protected $fillable = [
        'pelanggan_id',
        'total_tagihan',
        'tanggal_pembayaran',
        'metode_pembayaran',
    ];

    public function Pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }
}
