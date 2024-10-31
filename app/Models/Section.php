<?php

namespace App\Models;

use App\Models\Kurikulum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
    protected $table = 'section';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function kurikulum()
    {
        return $this->belongsTo(Kurikulum::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_section_status')
            ->withPivot('status');
    }
    public static function countSectionsByKurikulum($kurikulum_id)
    {
        return self::where('kurikulum_id', $kurikulum_id)->count();
    }
}
