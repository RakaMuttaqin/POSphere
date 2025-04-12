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
        Schema::create('detail_penjualan', function (Blueprint $table) {
            $table->string('kode')->primary();
            $table->string('kode_penjualan');
            $table->string('kode_barang');
            $table->string('kode_batch');
            $table->double('harga_beli');
            $table->double('harga_jual');
            $table->integer('jumlah');
            $table->integer('subtotal');

            $table->foreign('kode_penjualan')->references('kode')->on('penjualan')->onDelete('cascade');
            $table->foreign('kode_barang')->references('kode')->on('barang')->onDelete('cascade');
            $table->foreign('kode_batch')->references('kode')->on('batch')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_penjualan');
    }
};
