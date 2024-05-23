<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'produk';
    protected $guarded = [];
    public $timestamps = false;

    public function transaksi_items()
    {
        return $this->hasMany(Transaksi_items::class, 'id_produk');
    }
}
