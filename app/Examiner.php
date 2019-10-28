<?php

namespace App;

use App\Lecturer;
use App\FinalProject;
use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
{
    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function finalProject()
    {
        return $this->belongsTo(FinalProject::class);
    }
}
