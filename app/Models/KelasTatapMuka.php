<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class KelasTatapMuka extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'classroom_master';
    protected $primaryKey = 'id';

    protected $guarded = [];

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
        return $this->hasMany(Order::class, 'course_id');
    }

    // Mengatur slug
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama_kursus, '-') . '-' . Str::random(6);
            }
        });
    }
}
