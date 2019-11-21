<?php

namespace App;

use App\Role;
use App\Admin;
use App\FinalStudent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'gender', 'image_profile',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function finalStudent()
    {
        return $this->hasOne(FinalStudent::class);
    }

    public function recomendationTitles()
    {
        return $this->hasMany(RecomendationTitle::class);
    }

    public function hasRoles($roleName)
    {
        foreach ($this->roles as $role) {
            if ($role->name === $roleName) return true;
        }
        return false;
    }

    public function isStudent()
    {
        foreach ($this->roles as $role) {
            if ($role->name === "mahasiswa") return true;
        }
        return false;
    }

    public function isAdmin()
    {
        foreach ($this->roles as $role) {
            if ($role->name === 'admin') return true;
        }
        return false;
    }

    public function isCoordinator()
    {
        foreach ($this->roles as $role) {
            if ($role->name === 'koordinator') return true;
        }
        return false;
    }

    public function redirectTo()
    {
        if ($this->isCoordinator()) {
            return 'coordinator_dashboard.index';
        } elseif ($this->isAdmin()) {
            return 'final_project.index';
        } elseif ($this->isStudent()) {
            return 'final_registration.index';
        }
    }

    public static function getAuthId()
    {
        return Auth::user()->id;
    }

    public function isVerified()
    {
        return Auth::user()->finalStudent->is_verified;
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}
