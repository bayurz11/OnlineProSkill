<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kurikulum extends Model
{
    use HasFactory;
    protected $table = 'kurikulum';

    protected $guarded = [];

    public function KelasTatapMuka()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'course_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
