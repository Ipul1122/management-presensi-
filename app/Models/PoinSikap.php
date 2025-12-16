<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PoinSikap extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    
    // Casting agar detail_sikap otomatis jadi Array saat diambil
    protected $casts = [
        'detail_sikap' => 'array',
    ];

    // Relasi ke Murid (Opsional, untuk ambil foto/data lain)
    public function murid()
    {
        return $this->belongsTo(Murid::class, 'nama_murid', 'nama_anak');
    }
}