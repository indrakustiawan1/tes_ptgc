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
        Schema::create('transaksi_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('id_produk');
            $table->uuid('id_transaksi');
            $table->unsignedBigInteger('harga');
            $table->integer('jumlah');
            $table->unsignedBigInteger('subtotal_harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi_items');
    }
};
