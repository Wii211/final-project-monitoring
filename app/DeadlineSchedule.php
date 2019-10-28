<?php

namespace App;

use App\FinalStatus;
use Illuminate\Database\Eloquent\Model;

class DeadlineSchedule extends Model
{
    public function finalStatus()
    {
        return $this->belongsTo(FinalStatus::class);
    }
}
