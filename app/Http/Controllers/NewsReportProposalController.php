<?php

namespace App\Http\Controllers;

use App\FinalLog;
use Carbon\Carbon;
use App\FinalStatus;
use App\FinalProject;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use App\Http\Services\NewsReportService;

class NewsReportProposalController extends Controller
{
    public function show(
        $finalProjectId,
        NewsReportService $newsReportService,
        Request $request,
        DateHelper $dateHelper
    ) {
        $proposal = $newsReportService->generateReport(
            $finalProjectId,
            'proposal'
        );

        $todayDate = $dateHelper->getTodayDate();

        $finalProjectTitle = FinalProject::convertTitleForNewsReport(
            $proposal->finalProject->title
        );

        $thesisDefenceSchedule = $dateHelper->formatDateWithDayName(
            Carbon::parse($proposal->finalScheduleForReport->scheduled)
        );
        
        $thesisDate =  $dateHelper->formatDate(
            Carbon::parse(
                $proposal->finalScheduleForReport->scheduled
            ) 
        );

        $startTime = $dateHelper
            ->convertTimeHour($proposal->finalScheduleForReport->scheduled);

        $endTime = $dateHelper
            ->convertTimeHour($proposal->finalScheduleForReport->end_date);

        $thesisDefenceTime = $startTime . " - " . $endTime . " WITA";

        return view('news_reports.proposal', compact(
            'proposal',
            'todayDate',
            'finalProjectTitle',
            'thesisDefenceSchedule',
            'thesisDefenceTime',
            'thesisDate'
        ));
    }
}
