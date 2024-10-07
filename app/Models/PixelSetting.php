<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PixelSetting extends Model
{
    use HasFactory;
    protected $table = 'fb_setting';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
