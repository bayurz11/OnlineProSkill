<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Log extends Model
{
    use HasFactory;

    protected $fillable = [
        'action',
        'description',
        'user_id'
    ];

    // Relasi dengan tabel User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
