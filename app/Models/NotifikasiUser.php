<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifikasiUser extends Model
{
    use HasFactory;

    protected $table = 'notifikasi_users';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(KelasTatapMuka::class);
    }
}
