<?php

namespace App;

use App\FinalLog;
use App\DeadlineSchedule;
use Illuminate\Database\Eloquent\Model;

class FinalStatus extends Model
{
    public function deadlineSchedules()
    {
        return $this->hasMany(DeadlineSchedule::class);
    }

    public function finalLogs()
    {
        return $this->hasMany(FinalLog::class);
    }

    public function scopeName($query, $name)
    {
        return $query->whereName($name)->first()->id;
    }

    //Commented because finalStatus do response
    // public function getNameAttribute($value)
    // {
    //     return implode(" ", explode("_", $value));
    // }
}
