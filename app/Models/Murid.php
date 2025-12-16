<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MuridAbsensi;

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
        'jenis_alkitab',
        'tanggal_daftar',
        'nomor_telepon',
        'ayah',
        'ibu',
    ];

    public function absensis()
    {
        // Parameter: (Model Tujuan, Foreign Key di tabel tujuan, Local Key di tabel ini)
        // Foreign Key: 'nama_murid' (ada di tabel murid_absensis)
        // Local Key: 'nama_anak' (ada di tabel murids)
        return $this->hasMany(MuridAbsensi::class, 'nama_murid', 'nama_anak');
    }


}
