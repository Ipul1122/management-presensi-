<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MuridAbsensi extends Model
{
    protected $table = 'murid_absensis';
    protected $primarykey = 'id_absensi';

    public $incrementing = true;

    protected $fillable = [
        'nama_murid',
        'jenis_kelamin',
        'jenis_status',
        'jenis_bacaan',
        'tanggal_absen',
        'catatan',
    ];
}
