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
        Schema::create('barang', function (Blueprint $table) {
            $table->string('kode')->primary();
            $table->string('kode_jenis_barang');
            $table->string('nama');
            $table->string('barcode')->unique();
            $table->foreignId('satuan_id')->constrained('satuan')->onDelete('cascade');
            $table->string('gambar')->nullable();
            $table->double('harga_beli');
            $table->double('harga_jual');

            $table->foreign('kode_jenis_barang')->references('kode')->on('jenis_barang')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
