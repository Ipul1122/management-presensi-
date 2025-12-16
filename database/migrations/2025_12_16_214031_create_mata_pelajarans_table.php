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
            Schema::create('mata_pelajarans', function (Blueprint $table) {
                $table->id();
                $table->string('nama_murid');
                $table->string('nama_pengajar');
                $table->text('deskripsi')->nullable(); // Penjelasan materi/catatan
                $table->integer('nilai'); // Angka 1-10
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mata_pelajarans');
    }
};
