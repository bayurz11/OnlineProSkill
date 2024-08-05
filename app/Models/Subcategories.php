<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategories extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'name',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Categories::class);
    }
    public function courses()
    {
        return $this->hasMany(CourseMaster::class);
    }
    public function sertifikat()
    {
        return $this->hasMany(Sertifikat::class);
    }
}
