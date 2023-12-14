<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $fillable = ['nama_pelanggan', 'jenis_kelamin', 'alamat', 'no_telephone'];

    public function pesanan_laundry(): HasMany
    {
        return $this->hasMany(Pesanan_laundry::class, 'pelanggan_id', 'id');
    }

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class, 'pelanggan_id', 'id');
    }

}
