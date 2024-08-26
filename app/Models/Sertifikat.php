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

    // Relasi ke model KelasTatapMuka
    public function KelasTatapMuka()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'kategori_id');
    }
    public function course()
    {
        return $this->belongsTo(CourseMaster::class, 'product_id');
    }
}
