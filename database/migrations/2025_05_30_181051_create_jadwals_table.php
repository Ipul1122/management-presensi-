<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('jadwals', function (Blueprint $table) {
            $table->id(); // atau bisa ganti ke $table->string('id_jadwal')->primary(); jika kamu pakai ID custom
            $table->string('nama_jadwal');
            $table->date('tanggal_jadwal');
            $table->string('pukul_jadwal');
            $table->string('nama_pengajar_jadwal');
            $table->text('kegiatan_jadwal');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('jadwals');
    }
};
