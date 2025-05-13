<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenggunaTable extends Migration
{
    public function up(): void
{
    Schema::create('pengguna', function (Blueprint $table) {
        $table->id();
        $table->string('username')->unique();
        $table->string('password');
        $table->string('role'); // admin / pengajar
        $table->rememberToken(); // ← penting untuk Laravel Auth
        $table->timestamps();
    });
}

    public function down()
    {
        Schema::dropIfExists('pengguna');
    }
}