<?php

namespace App\Http\Services;

use App\FinalLog;
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
                'finalScheduleForReport', 'finalProject.finalStudent'
            ])
            ->first();

        return $finalProject;
    }
}
