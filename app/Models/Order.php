<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order';

    protected $guarded = [];


    public function product()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'id');
    }
}
