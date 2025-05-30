<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;

    protected $table = 'jadwals'; // pastikan nama tabel sesuai dengan yang ada di database

    protected $primaryKey = 'id'; // default 'id', bisa diganti jika berbeda

    protected $fillable = [
        'nama_jadwal',
        'tanggal_jadwal',
        'pukul_jadwal',
        'nama_pengajar_jadwal',
        'kegiatan_jadwal',
    ];
}
