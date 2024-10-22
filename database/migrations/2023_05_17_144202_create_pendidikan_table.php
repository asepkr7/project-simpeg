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
        Schema::create('pendidikan', function (Blueprint $table) {
            $table->id('id_pendidikan');
            $table->foreignId('id_pegawai');
            $table->string('nama_sekolah')->default(50);
            $table->string('lokasi')->default(50);
            $table->string('no_ijazah')->default(30);
            $table->date('tanggal_ijazah');
            $table->string('nama_kepsek')->default(50);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pendidikan');
    }
};
