<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sertifikat extends Model
{
    use HasFactory;
    protected $table = 'sertifikat';
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
}
