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
        Schema::create('pengajuan_barang', function (Blueprint $table) {
            $table->string('kode_pengajuan')->primary();
            $table->string('kode_member');
            $table->string('nama_barang');
            $table->date('tanggal_pengajuan');
            $table->integer('qty');
            $table->string('status', 2); // 0 = Tidak Terpenuhi, 1 = Terpenuhi

            $table->foreign('kode_member')->references('kode')->on('member')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_barang');
    }
};
