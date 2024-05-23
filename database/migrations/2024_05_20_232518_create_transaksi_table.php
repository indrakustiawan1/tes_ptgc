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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('customer_name');
            $table->string('customer_no_hp');
            $table->string('customer_email');
            $table->text('customer_address');
            // $table->date('transaction_date');
            $table->decimal('total_harga', 10, 2);
            $table->decimal('total_dibayar', 10, 2);
            $table->string('invoice');
            $table->string('kode_voucher');
            $table->string('status_voucher');
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
