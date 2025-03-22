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
        Schema::create('member', function (Blueprint $table) {
            $table->string('kode')->primary();
            $table->string('kode_jenis_member');
            $table->string('nama');
            $table->string('no_hp')->unique();
            $table->string('email')->unique();
            $table->string('alamat');
            $table->date('tanggal_bergabung');

            $table->foreign('kode_jenis_member')->references('kode')->on('jenis_member')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member');
    }
};
