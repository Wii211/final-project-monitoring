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

        $finalProject = FinalProject::whereFinalStudentId($finalStudent->getStudentId())->first();

        if (!$finalProject) {
            return "Anda Masih Dalam Tahap Pendaftaran";
        }

        $finalLog = FinalLog::whereFinalProjectId($finalProject->id)->latest()->first();

        $deadlineSchedule = $this->whereFinalStatusId($finalLog->final_status_id)->first();

        $endDate = Carbon::parse($deadlineSchedule->end_date);

        if ($endDate->isPast()) {
            return true;
        } else {
            return false;
        }
    }
}
