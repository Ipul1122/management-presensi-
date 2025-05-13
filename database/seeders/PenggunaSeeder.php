<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pengguna')->insert([
            [
                'username' => 'admin',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
            ],
            [
                'username' => 'pengajar1',
                'password' => Hash::make('pengajar123'),
                'role' => 'pengajar',
            ],
            [
                'username' => 'pengajar2',
                'password' => Hash::make('pengajar123'),
                'role' => 'pengajar',
            ],
        ]);
    }
}

