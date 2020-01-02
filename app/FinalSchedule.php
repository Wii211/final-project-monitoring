<?php

namespace App;

use App\FinalLog;
use Carbon\Carbon;
use App\FinalProject;
use Illuminate\Database\Eloquent\Model;

class FinalSchedule extends Model
{
    protected $guarded = ['id'];
    protected $appends = ['date', 'hour'];

    public function finalLog()
    {
        return $this->belongsTo(FinalLog::class, 'final_log_id');
    }

    public static function convertTime($dateTime)
    {
        return Carbon::createFromFormat('Y-m-d H:i', $dateTime)->toDateTimeString();
    }

    public function getDateAttribute()
    {
        $date = explode(" ", $this->scheduled);

        return $date[0];
    }

    public function getHourAttribute()
    {
        $date = explode(" ", $this->scheduled);

        return $date[1];
    }

    public function scheduleStatus()
    {
        $finalProjectId = new FinalProject;
        $finalProjectId = $finalProjectId->getFinalProjectFromStudent->id;
        $finalLogId = FinalLog::whereFinalProjectId($finalProjectId)
            ->latest()->first()->id;

        return $this->whereFinalLogId($finalLogId)->latest()->first()->status;
    }
}
