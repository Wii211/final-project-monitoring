<?php

namespace App;

use App\DeadlineSchedule;
use Illuminate\Database\Eloquent\Model;

class FinalStatus extends Model
{
    public function deadlineSchedules()
    {
        return $this->hasMany(DeadlineSchedule::class);
    }
}
