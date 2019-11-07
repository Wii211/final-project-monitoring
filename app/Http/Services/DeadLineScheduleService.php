<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\DeadlineSchedule;

class DeadLineScheduleService
{
    private $deadlineSchedule;

    public function __construct(DeadlineSchedule $deadlineSchedule)
    {
        $this->deadlineSchedule = $deadlineSchedule;
    }
    public function showProposalRegisterDeadLine()
    {
        //Where finalStatusId = 1 is proposalRegister in database
        $deadlineSchedule = $this->deadlineSchedule->whereFinalStatusId(1)->first();

        $endDate = Carbon::parse($deadlineSchedule->end_date);

        $differenceBetweenDate = $endDate->diffInDays(Carbon::now());

        return compact('endDate', 'differenceBetweenDate');
    }
}
