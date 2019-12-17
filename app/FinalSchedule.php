<?php

namespace App;

use App\FinalLog;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class FinalSchedule extends Model
{
    protected $guarded = ['id'];

    public function finalLog()
    {
        return $this->belongsTo(FinalLog::class, 'final_log_id');
    }

    public static function convertTime($dateTime)
    {
        return Carbon::createFromFormat('Y-m-d H:i', $dateTime)->toDateTimeString();
    }
}
