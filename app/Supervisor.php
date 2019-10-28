<?php

namespace App;

use App\Lecturer;
use App\FinalProject;
use App\FinalProgress;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function finalProject()
    {
        return $this->belongsTo(FinalProject::class);
    }

    public function finalProgresses()
    {
        return $this->hasMany(FinalProgress::class);
    }
}
