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
        Schema::create('batch', function (Blueprint $table) {
            $table->string('kode')->primary();
            $table->string('kode_barang');
            $table->integer('stok');
            $table->dateTime('tanggal_produksi');
            $table->dateTime('tanggal_expired');

            $table->foreign('kode_barang')->references('kode')->on('barang')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch');
    }
};
