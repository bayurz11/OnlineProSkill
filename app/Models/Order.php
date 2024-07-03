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
        return $this->belongsTo(KelasTatapMuka::class, 'kelas_tatap_muka_id');
    }
    // public function KelasTatapMuka()
    // {
    //     return $this->belongsTo(KelasTatapMuka::class);
    // }
}
