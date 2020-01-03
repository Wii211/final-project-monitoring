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

        if ($finalStatusId === FinalStatus::name('tugas_akhir_selesai')) {
            return false;
        }


        $deadlineSchedule = $this->whereFinalStatusId($finalStatusId)
            ->first();

        $endDate = Carbon::parse($deadlineSchedule->end_date);

        return $endDate->isPast() ? true : false;
    }

    public function scheduleValidation($finalStatuses)
    {

        foreach ($finalStatuses as $key => $finalStatus) {

            if ($key === 'registration' || $key === 'pre_proposal' || $key === 'proposal') {
                if (Carbon::parse($finalStatus['start_date'])
                    ->greaterThan(Carbon::parse($finalStatus['end_date']))
                ) return false;
            }
        }
        return true;
    }
}
