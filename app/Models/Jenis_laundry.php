<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis_laundry extends Model
{
    use HasFactory;
    protected $table = 'jenis_laundries';
    protected $fillable = ['jenis_laundry', 'lama_proses', 'tarif'];

    public function transaksi_laundry():HasMany
    {
        return $this->hasMany(Transaksi_laundry::class);
    }
}
