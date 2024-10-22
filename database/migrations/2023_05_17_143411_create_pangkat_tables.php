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
        Schema::create('pangkat', function (Blueprint $table) {
            $table->id('id_pangkat');
            $table->foreignId('id_pegawai');
            $table->string('nama_pangkat')->default(30);
            $table->string('golongan')->default(20);
            $table->string('jenis_pangkat')->default(30);
            $table->date('tmt_pangkat_awal');
            $table->date('tmt_pangkat_akhir');
            $table->string('no_sk')->default(30);
            $table->date('tanggal_sk');
            $table->string('pengesah')->default(50);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pangkat');
    }
};
