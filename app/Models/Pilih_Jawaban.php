<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilih_Jawaban extends Model
{
    use HasFactory;
    protected $table = 'pilihan_jawaban';
    protected $primaryKey = 'id_pilihan';

    protected $guarded = [];
}
