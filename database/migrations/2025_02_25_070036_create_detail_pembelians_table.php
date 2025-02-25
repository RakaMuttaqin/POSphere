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
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->string('kode')->primary();
            $table->string('kode_pembelian');
            $table->string('kode_barang');
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->integer('jumlah');

            $table->foreign('kode_pembelian')->references('kode')->on('pembelian')->onDelete('cascade');
            $table->foreign('kode_barang')->references('kode')->on('barang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pembelian');
    }
};
