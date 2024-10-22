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
        Schema::create('pensiun', function (Blueprint $table) {
            $table->id();
           $table->bigInteger('pegawai_id')->unsigned();
            $table->string('jenis_pensiun',30);
            $table->date('tmt_pensiun');
            $table->string('masa_kerja',20);
            $table->string('alamat_pensun',50);
            $table->string('cltn',30);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pensiun');
    }
};