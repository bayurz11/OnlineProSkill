<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pertanyaan extends Model
{
    use HasFactory;
    protected $table = 'pertanyaan';
    protected $primaryKey = 'id_pertanyaan';

    protected $guarded = [];

    public function kelasTatapMuka()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'course_id', 'id');
    }
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'id_tugas');
    }
}
