<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KelasTatapMuka extends Model
{
    use HasFactory;
    use Sluggable;
    // Nama tabel
    protected $table = 'classroom_master';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'nama_kursus'
            ]
        ];
    }
    // Relasi ke model Kategori
    public function kategori()
    {
        return $this->belongsTo(Categories::class);
    }

    // Relasi ke model Subkategori
    public function subkategori()
    {
        return $this->belongsTo(Subcategories::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class, 'product_id');
    }
    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }

    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class);
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'class_id', 'id');
    }
}
