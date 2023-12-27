<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_laporan extends Model
{
    use HasFactory;
    protected $table = 'data_laporans';
    protected $fillable = ['tanggal', 'catatan', 'pengeluaran'];

    public function data_pengeluaran()
    {
        return $this->hasOne(Data_Pengeluaran::class);
    }
}
