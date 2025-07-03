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
       // database/migrations/xxxx_xx_xx_create_murids_table.php
        Schema::create('murids', function (Blueprint $table) {
            $table->id('id_pendaftaran');
            $table->string('nama_anak'); // string biasa, bukan foreign key
            $table->string('foto_anak')->nullable();
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->text('alamat');
            $table->string('kelas');
            $table->enum('jenis_alkitab', ['iqro', 'Al-Quran']);
            $table->date('tanggal_daftar');
            // Ubah dari integer ke string
            $table->string('nomor_telepon');
            $table->string('ayah');
            $table->string('ibu');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('murids');
    }
};
