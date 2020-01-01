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
                'finalProject.supervisors', 'finalProject.examiners',
                'finalSchedules'
            ])
            ->first();

        return $finalProject;
    }
}
