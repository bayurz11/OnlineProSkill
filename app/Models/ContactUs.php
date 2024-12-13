<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactUs extends Model
{
    use HasFactory;
    protected $table = 'contactus';
    protected $primaryKey = 'id';

    protected $guarded = [];

    protected $fillable = [
        'alamat',
        'telepon',
        'email',
        // kolom lain...
    ];

    protected $casts = [
        'telepon' => 'array',
        'email' => 'array',
    ];
}
