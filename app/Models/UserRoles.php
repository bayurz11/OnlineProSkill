<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserRoles extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'user_role';
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
}
