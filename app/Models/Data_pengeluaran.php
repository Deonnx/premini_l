<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'data_pengeluarans';
    protected $fillable = ['laporan_id','tanggal', 'catatan', 'pengeluaran','status'];


public function laporan()
    {
        return $this->belongsTo(Data_laporan::class, 'laporan_id');
    }
}