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
        Schema::create('diklat', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pegawai_id')->unsigned();
            $table->string('diklat', 50);
            $table->integer('jam');
            $table->string('penyelenggara', 50);
            $table->string('tempat', 50);
            $table->string('angkatan', 30);
            $table->integer('tahun');
            $table->string('no_sttpp', 50);
            $table->date('tanggal_sttpp');
            $table->string('file', 150);
            // $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diklat');
    }
};
