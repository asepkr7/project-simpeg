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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('pegawai_id')->unsigned();
            $table->string('level', 10);
            $table->string('username', 50)->unique();
            $table->string('password');
            $table->rememberToken();
        });
//         Schema::table('pegawais', function (Blueprint $table) {
//     $table->foreignId('pegawai_id')->references('id')->on('pegawais')
//     ->onDelete('cascade')->onUpdate('cescade');
// });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
