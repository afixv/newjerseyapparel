<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'harga',
        'harga_promo',
        'deskripsi',
        'gambar',
        'minimal_order',
        'bahan',
    ];
}
