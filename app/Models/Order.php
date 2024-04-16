<?php

namespace App\Models;

use App\Models\Service;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_hp',
        'alamat',
        'status',
        'total_harga',
        'jumlah_pesanan',
        'keterangan',
        'link_desain',
        'request_desain',
    ];

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
