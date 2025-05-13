<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ← WAJIB ini
use Illuminate\Notifications\Notifiable;

class Pengguna extends Authenticatable
{
    use Notifiable;

    protected $table = 'pengguna';

    protected $fillable = [
        'username',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
    ];
}
