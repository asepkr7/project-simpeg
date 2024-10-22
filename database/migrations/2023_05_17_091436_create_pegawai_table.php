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
        Schema::create('pegawai', function (Blueprint $table) {
            $table->id();
            $table->string('nip', 30)->unique();
            $table->string('nama', 50);
            $table->string('gelar_depan', 20)->nullable();
            $table->string('gelar_belakang', 20)->nullable();
            $table->string('tempat_lahir', 50);
            $table->date('tanggal_lahir');
            $table->char('gender', 2);
            $table->string('agama', 30);
            $table->char('gol_darah', 10);
            $table->string('status_pernikahan', 20);
            $table->string('nik', 20);
            $table->string('telp', 20);
            $table->string('alamat');
            $table->string('email', 50);
            $table->string('npwp', 20);
            $table->string('bpjs', 20);
            $table->string('karpeg', 20);
            $table->string('status_kepegawaian', 20);
            $table->string('no_sk_cpns', 30);
            $table->date('tmt_sk_cpns');
            $table->string('no_sk_pns', 30);
            $table->date('tmt_sk_pns');
            $table->integer('tpp');
            $table->string('image')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pegawai');
    }
};
