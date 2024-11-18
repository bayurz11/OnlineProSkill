<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jawaban_Siswa extends Model
{
    use HasFactory;
    protected $table = 'jawaban_siswa';

    protected $fillable = [
        'id_pertanyaan',
        'id_siswa',
        'jawaban_essay',
        'id_pilihan',
        'nilai',
    ];
}
