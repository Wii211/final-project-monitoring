<?php

namespace App;

use App\Lecturer;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    public function lecturers()
    {
        return $this->hasMany(Lecturer::class);
    }

    public function lecturersPrimary()
    {
        return $this->hasMany(Lecturer::class)->primary();
    }

    public function scopePrimary($query)
    {
        return $query->whereIsPrimary(1);
    }
}
