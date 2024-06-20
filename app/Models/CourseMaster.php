<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseMaster extends Model
{
    use HasFactory;
    // Nama tabel
    protected $table = 'course_master';

    // Kolom yang dapat diisi
    protected $fillable = [
        'nama_kursus',
        'kategori_id',
        'subkategori_id',
        'deskripsi',
        'tingkat',
        'include',
        'harga',
        'diskon',
        'harga_setelah_diskon',
        'gratis',
        'gambar',
        'tag',
    ];

    // Mengonversi kolom 'include' dari/ke format JSON
    protected $casts = [
        'include' => 'array',
    ];

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
