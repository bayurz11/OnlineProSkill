<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\UserSectionStatus;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'gauth_id',
        'gauth_type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function userRole()
    {
        return $this->hasOne(UserRoles::class);
    }
    public function userProfile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function sectionStatuses()
    {
        return $this->hasMany(UserSectionStatus::class);
    }

    // Mengecek apakah pengguna telah menyelesaikan bagian tertentu
    public function hasCompletedSection($sectionId)
    {
        return $this->sectionStatuses()->where('section_id', $sectionId)->where('status', true)->exists();
    }
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'user_id');
    }
}
