<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saldo extends Model
{
    use HasFactory;
    
    protected $table = 'saldo';
    protected $fillable = [
        'user_id',
        'jumlah',
    ];

    // Hubungan dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function data_pengeluaran()
    {
        return $this->hasMany(Data_pengeluaran::class, 'user_id', 'user_id');
    }

    
}
