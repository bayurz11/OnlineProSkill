<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kurikulum extends Model
{
    use HasFactory;
    protected $table = 'kurikulum';

    protected $guarded = [];

    public function KelasTatapMuka()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'course_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
}
