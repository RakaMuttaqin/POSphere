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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->string('kode')->primary();
            $table->string('kode_penjualan');
            $table->double('total_bayar');
            $table->double('kembalian');
            $table->string('metode_pembayaran');
            $table->dateTime('tanggal_bayar');

            $table->foreign('kode_penjualan')->references('kode')->on('penjualan')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
