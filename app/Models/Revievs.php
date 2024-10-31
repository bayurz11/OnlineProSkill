<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revievs extends Model
{
    use HasFactory;
    protected $table = 'reviews';
    protected $primaryKey = 'id';

    protected $guarded = [];
}
