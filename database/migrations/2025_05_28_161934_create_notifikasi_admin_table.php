<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('notifikasi_admins', function (Blueprint $table) {
            $table->id();
            $table->string('aksi'); // contoh: "Tambah data murid", "Edit data pengajar"
            $table->text('deskripsi'); // contoh: "Admin menambahkan murid bernama Ahmad"
            $table->boolean('is_read')->default(false); // <-- Tambahan ini
            $table->timestamps(); // created_at digunakan untuk urutan notifikasi
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi_admins');
    }
};