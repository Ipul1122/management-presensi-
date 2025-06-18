<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TestimoniUser extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_user',
        'foto_user',
        'isi_testimoni',
        'status',
    ];
}
