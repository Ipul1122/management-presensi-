<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Pengguna;

class PenggunaSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin Utama (Tetap)
        Pengguna::updateOrCreate(
            ['username' => 'admintpa'],
            [
                'password' => Hash::make('tpanurulhaq2026'), // Password default (kosong) sesuai file asli
                'role' => 'admin',
            ]
        );

        Pengguna::updateOrCreate(
            ['username' => 'Syaiful'],
            [
                'password' => Hash::make('Syaiful18102002'), // Password default (kosong) sesuai file asli
                'role' => 'admin',
            ]
        );

        // 2. Daftar Pengajar Baru
        // Pengajar 1 (Syaiful) - Note: Ini akan mengupdate role 'syaiful' jika sebelumnya admin
        Pengguna::updateOrCreate(
            ['username' => 'Syaiful'],
            [
                'password' => Hash::make('Syaiful2002'),
                'role' => 'pengajar',
            ]
        );

        // Pengajar 2 (Rini)
        Pengguna::updateOrCreate(
            ['username' => 'Rini'],
            [
                'password' => Hash::make('Rini2026'),
                'role' => 'pengajar',
            ]
        );

        // Pengajar 3 (Vivi)
        Pengguna::updateOrCreate(
            ['username' => 'Vivi'],
            [
                'password' => Hash::make('Vivi2026'),
                'role' => 'pengajar',
            ]
        );

        // Pengajar 4 (Nurul)
        Pengguna::updateOrCreate(
            ['username' => 'Nurul'],
            [
                'password' => Hash::make('Nurul2026'),
                'role' => 'pengajar',
            ]
        );

        // Pengajar 5 (Isam)
        Pengguna::updateOrCreate(
            ['username' => 'Isam'],
            [
                'password' => Hash::make('Isam2026'),
                'role' => 'pengajar',
            ]
        );

        // Pengajar 6 (Dila)
        Pengguna::updateOrCreate(
            ['username' => 'Dila'],
            [
                'password' => Hash::make('Dila2026'),
                'role' => 'pengajar',
            ]
        );

        // Pengajar 7 (Hanif)
        Pengguna::updateOrCreate(
            ['username' => 'Hanif'],
            [
                'password' => Hash::make('Hanif2026'),
                'role' => 'pengajar',
            ]
        );

        // Pengajar 8 (Zidan)
        Pengguna::updateOrCreate(
            ['username' => 'Zidan'],
            [
                'password' => Hash::make('Zidan2026'),
                'role' => 'pengajar',
            ]
        );
        
        // Opsional: Menghapus data dummy lama jika ada (iqro & alquran)
        Pengguna::whereIn('username', ['iqro', 'alquran'])->delete();
    }
}