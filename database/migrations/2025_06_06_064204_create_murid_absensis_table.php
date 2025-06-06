<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('murid_absensis', function (Blueprint $table) {
            $table->id();
            $table->string('nama_murid');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->enum('jenis_bacaan', [ 'Iqro', 'Al-Quran']);
            $table->enum('jenis_status', ['Hadir', 'Izin']);
            $table->date('tanggal_absen');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('murid_absensis');
    }
};
