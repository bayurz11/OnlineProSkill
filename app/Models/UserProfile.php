<?php

namespace App\Models;

use App\Models\UserRoles;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserProfile extends Model
{
    use HasFactory;
    protected $table = 'user_profile';
    protected $primaryKey = 'id';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function userRole()
    {
        return $this->hasOne(UserRoles::class);
    }
}
