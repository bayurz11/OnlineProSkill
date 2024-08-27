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
    // Di dalam model Sertifikat
    public function product()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'product_id');
    }

    public function course()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'product_id');
    }
    public function userProfile()
    {
        return $this->belongsTo(UserProfile::class, 'user_id', 'id');
    }
}
