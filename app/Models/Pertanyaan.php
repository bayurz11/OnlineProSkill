<?php

namespace App\Models;

use App\Models\Tugas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';
    protected $fillable = ['isi_pertanyaan', 'jenis_pertanyaan', 'id_tugas'];
    protected $guarded = [];

    public function kelasTatapMuka()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'course_id', 'id');
    }
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas');
    }
    public function jawaban()
    {
        return $this->hasMany(Jawaban_Siswa::class, 'id_pertanyaan');
    }
}
