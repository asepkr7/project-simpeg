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
        Schema::create('anak', function (Blueprint $table) {
            $table->id('id_anak');
            $table->foreignId('id_pegawai');
            $table->string('nama')->default(50);
            $table->string('nik')->default(20);
            $table->string('tempat_lahir')->default(50);
            $table->date('tanggal_lahir');
            $table->string('gender')->default(20);
            $table->string('agama')->default(30);
            $table->string('pendidikan')->default(30);
            $table->string('status_anak')->default(30);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anak');
    }
};
