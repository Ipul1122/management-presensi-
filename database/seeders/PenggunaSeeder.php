<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
   public function run(): void
{
    // Admin
    Pengguna::create([
        'username' => 'admintpa',
        'password' => Hash::make(''),
        'role' => 'admin',
    ]);

    // Pengajar 1
    Pengguna::create([
        'username' => 'iqro',
        'password' => Hash::make('iqro2025'),
        'role' => 'pengajar',
    ]);

    // Pengajar 2
    Pengguna::create([
        'username' => 'alquran',
        'password' => Hash::make('alquran2025'),
        'role' => 'pengajar',
    ]);
}
}

