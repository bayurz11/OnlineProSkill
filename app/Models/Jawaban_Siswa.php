<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban_Siswa extends Model
{
    use HasFactory;

    protected $table = 'jawaban_siswa';
    protected $primaryKey = 'id_jawaban';
    protected $fillable = [
        'id_pertanyaan',
        'id_siswa',
        'jawaban_essay',
        'id_pilihan',
        'nilai',
    ];

    // Relasi ke tabel Pertanyaan
    public function pertanyaan()
    {
        return $this->belongsTo(Pertanyaan::class, 'id_pertanyaan');
    }

    // Relasi ke tabel PilihanJawaban
    public function pilihanJawaban()
    {
        return $this->belongsTo(Pilih_Jawaban::class, 'id_pilihan');
    }

    // Relasi ke tabel Users (Siswa)
    public function siswa()
    {
        return $this->belongsTo(User::class);
    }
}
