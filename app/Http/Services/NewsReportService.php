<?php

namespace App\Http\Services;

use App\FinalLog;
use Carbon\Carbon;
use App\FinalStatus;


class NewsReportService
{
    public function generateReport($finalProjectId, $statusName)
    {



        $finalProject = FinalLog::whereFinalProjectId($finalProjectId)
            ->whereFinalStatusId(FinalStatus::name($statusName))
            ->with([
                'finalProject.supervisors.lecturer',
                'finalProject.examiners.lecturer',
                'finalSchedules', 'finalProject.finalStudent'
            ])
            ->first();

        return $finalProject;
    }

    public function getTodayDate()
    {
        setlocale(LC_TIME, 'id_ID.utf8');

        return Carbon::now()->formatLocalized('%d %B %Y');
    }
}
