<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pesanan_laundry extends Model
{
    use HasFactory;
    protected $table = 'pesanan_laundries'; //ini buat nama tabel nya

    protected $fillable = [
        'pelanggan_id',
        'berat',
        'tanggal_terima',
        'tanggal_selesai',
        'status',
    ];

    public function Pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id', 'id');
    }
}
