<?php

namespace App\Models;

use App\Models\KelasTatapMuka;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KategoriProduk extends Model
{
    use HasFactory;
    protected $table = 'kategori_produk';

    protected $guarded = [];
    protected $fillable = [
        'name_kategori',
        'status',
    ];

    public function kelastatapmuka()
    {
        return $this->hasMany(KelasTatapMuka::class, 'kategori_id');
    }
}
