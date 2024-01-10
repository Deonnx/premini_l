<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DataLaundry extends Model
{
    use HasFactory;
    protected $table = 'datalaundries';
    protected $fillable = ['data_pelanggan_id', 'jenis_laundry_id', 'tarif','tanggal_selesai', 'jumlah_kelo', 'total_bayar', 'status'];

    public function data_pelanggan()
    {
        return $this->belongsTo(Data_pelanggan::class, 'data_pelanggan_id',);
    }

    public function jenis_laundry()
    {
        return $this->belongsTo(Jenis_laundry::class, 'jenis_laundry_id',);
    }
}
