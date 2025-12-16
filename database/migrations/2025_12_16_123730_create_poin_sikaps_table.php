<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('poin_sikaps', function (Blueprint $table) {
            $table->id();
            $table->string('nama_murid');
            $table->string('nama_pengajar'); // Siapa yang menilai
            $table->integer('jumlah_poin'); // Total poin dari inputan ini
            $table->text('detail_sikap'); // Menyimpan pilihan (Jujur, Disiplin, dll)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('poin_sikaps');
    }
};