<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_laporan extends Model
{
    use HasFactory;
    protected $table = 'data_laporans';
    protected $fillable = ['tanggal', 'catatan', 'pengeluaran','status'];

    public function data_pengeluaran()
    {
        return $this->hasMany(Data_pengeluaran::class);
    }

    // Fungsi untuk mengubah status
    public function changeStatus($status)
    {
        $this->update(['status' => $status]);
    }
}
