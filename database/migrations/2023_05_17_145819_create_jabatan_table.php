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
        Schema::create('jabatan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pegawai_id')->unsigned();
            $table->string('jabatan')->default('30');
            $table->string('eselon')->default('30');
            $table->string('jenis_jabatan')->default('30');
            $table->date('tmt_jbtn_mulai');
            $table->date('tmt_jbtn_akhir');
            $table->string('periode')->default('30');
            $table->string('no_sk')->default('30');
            $table->date('tgl_sk');
            $table->date('tahun');
            $table->string('pejabat_sk')->default('50');
            $table->string('file');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatan');
    }
};