<?php

namespace App\Models;

use App\Events\OrderStatusChanged;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public static function boot()
    {
        parent::boot();

        // Trigger event jika status berubah
        static::updated(function ($order) {
            if ($order->isDirty('status')) {
                event(new OrderStatusChanged($order));
            }
        });
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'class_id', 'product_id');
    }
}
