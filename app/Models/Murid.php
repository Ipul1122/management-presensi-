<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Murid extends Model
{
    use HasFactory;

    protected $table = 'murids'; 
    protected $primaryKey = 'id_pendaftaran';

    protected $fillable = [
        'nama_anak',
        'foto_anak',
        'jenis_kelamin',
        'alamat',
        'kelas',
        'tanggal_daftar',
    ];


}
