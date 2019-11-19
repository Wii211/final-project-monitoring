<?php

namespace App;

use App\NewsReport;
use App\FinalStatus;
use App\FinalProject;
use App\FinalSchedule;
use Illuminate\Database\Eloquent\Model;

class FinalLog extends Model
{
    public function newsReport()
    {
        return $this->hasOne(NewsReport::class);
    }

    public function finalSchedules()
    {
        return $this->hasMany(FinalSchedule::class);
    }

    public function finalProject()
    {
        return $this->belongsTo(FinalProject::class);
    }

    public function finalStatus()
    {
        return $this->belongsTo(FinalStatus::class);
    }

    public function proposalExist($finalProjectId)
    {
        if ($this->whereFinalProjectId($finalProjectId)
            ->whereRole(FinalStatus::name('proposal'))->first()
        ) {
            return true;
        } else {
            return false;
        }
    }
}
