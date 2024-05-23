<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi_items extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'transaksi_items';
    protected $guarded = [];
    public $timestamps = false;

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    // Relasi ke model Transaksi
    public function transaksi()
    {
        return $this->belongsTo(Transaksi::class, 'id_transaksi');
    }
}
