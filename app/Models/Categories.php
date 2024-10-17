<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_category',
        'gambar',
        'status',
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategories::class);
    }
    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class);
    }
    public function kelastatapmuka()
    {
        return $this->hasMany(KelasTatapMuka::class);
    }
}
