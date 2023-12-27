<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data_pengeluaran extends Model
{
    use HasFactory;
    protected $table = 'data_pengeluarans';
    protected $fillable = ['tanggal', 'catatan', 'pengeluaran'];

}
