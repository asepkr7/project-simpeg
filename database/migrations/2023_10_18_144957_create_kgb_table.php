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
    Schema::create('kgb', function (Blueprint $table) {
        $table->id();
        $table->bigInteger('pegawai_id')->unsigned();
        $table->string('pejabat_sk_lama', 50);
        $table->decimal('gapok_lama', 10, 2);
        $table->date('tmt_lama');
        $table->string('masa_kerja_lama', 20);
        $table->string('no_sk_lama', 20);
        $table->date('tanggal_sk_lama');
        $table->decimal('gapok_baru', 10, 2);
        $table->date('tmt_baru');
        $table->string('masa_kerja_baru', 20);
        $table->string('nomor', 30);
        $table->date('tanggal');
        $table->date('naik_lanjut');

        // Index example (modify as needed)
        $table->index('pegawai_id');

        $table->foreign('pegawai_id')->references('id')->on('pegawai')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kgb');
    }
};