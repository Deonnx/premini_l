<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenarikan extends Model
{
    use HasFactory;
    protected $table = 'data_penarikans';
    protected $fillable = [
        'user_id',
        'jumlah_penarikan',
        'status',
        'tanggal',
        'metode_penarikan',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saldo()
    {
        return $this->belongsTo(Saldo::class, 'user_id', 'user_id');
    }
}