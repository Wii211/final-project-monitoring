<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function scopeName($query, $name)
    {

        return $query->whereName($name);
    }
}
