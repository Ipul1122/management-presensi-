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
        'username' => 'admin',
        'password' => Hash::make('admin123'),
        'role' => 'admin',
    ]);

    // Pengajar 1
    Pengguna::create([
        'username' => 'pengajar1',
        'password' => Hash::make('pengajar123'),
        'role' => 'pengajar',
    ]);

    // Pengajar 2
    Pengguna::create([
        'username' => 'pengajar2',
        'password' => Hash::make('pengajar123'),
        'role' => 'pengajar',
    ]);
}
}

