<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;
    protected $table = 'tugas';
    protected $primaryKey = 'id_tugas';

    protected $guarded = [];

    public function kelasTatapMuka()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'course_id', 'id');
    }
    public function pertanyaan()
    {
        return $this->hasMany(Pertanyaan::class, 'id_tugas');
    }
}
