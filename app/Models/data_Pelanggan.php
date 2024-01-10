<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class data_Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'pelanggans';
    protected $fillable = ['nama_pelanggan', 'jenis_kelamin', 'alamat', 'no_telephone','foto_pelanggan'];

    public function transaksi_laundry(): HasMany
    {
        return $this->hasMany(Transaksi_laundry::class);
    }

}