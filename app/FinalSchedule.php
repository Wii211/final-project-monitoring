<?php

namespace App;

use App\FinalLog;
use Illuminate\Database\Eloquent\Model;

class FinalSchedule extends Model
{
    protected $guarded = ['id'];

    public function finalLog()
    {
        return $this->belongsTo(FinalLog::class, 'final_log_id');
    }
}
