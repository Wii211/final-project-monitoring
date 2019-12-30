<?php

namespace App;

use App\FinalLog;
use Carbon\Carbon;
use App\FinalStatus;
use App\FinalProject;
use App\FinalStudent;
use Illuminate\Database\Eloquent\Model;

class DeadlineSchedule extends Model
{
    public function finalStatus()
    {
        return $this->belongsTo(FinalStatus::class);
    }

    public function checkPastDeadLineSchedule()
    {
        $finalStudent = new FinalStudent;

        $finalProject = FinalProject::whereFinalStudentId($finalStudent->getStudentId())
            ->first();

        $finalStatusId = null;

        if (!$finalProject) {
            $finalStatusId = FinalStatus::name('pendaftaran');
        } else {
            $finalLog = FinalLog::whereFinalProjectId($finalProject->id)
                ->latest()->first();

            $finalStatusId = $finalLog->final_status_id;
        }

        $deadlineSchedule = $this->whereFinalStatusId($finalStatusId)
            ->first();

        $endDate = Carbon::parse($deadlineSchedule->end_date);

        return $endDate->isPast() ? true : false;
    }
}
