<?php

namespace App\Models;

use App\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
