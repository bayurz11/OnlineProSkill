<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $guarded = [];

    public function KelasTatapMuka()
    {
        return $this->belongsTo(KelasTatapMuka::class, 'product_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function KelasTatapMuka()
    // {
    //     return $this->belongsTo(KelasTatapMuka::class);
    // }
}
