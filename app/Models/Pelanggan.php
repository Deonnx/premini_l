<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pelanggan extends Model
{
    use HasFactory;
    protected $table = 'Pelanggans';
    protected $fillable = ['nama_pelanggan', 'jenis_kelamin', 'alamat', 'no_telephone','foto_pelanggan'];

    public function pelanggan()
    {
        return $this->hasOne(data_pelanggan::class);
    }
}
