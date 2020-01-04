<?php

namespace App\Http\Controllers;

use App\FinalLog;
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

        $thesisDefenceSchedule = $dateHelper->formatDate(
            $proposal->final_schedule_for_report->scheduled
        );

        $startTime = $dateHelper
            ->convertTimeHour($proposal->final_schedule_for_report->scheduled);

        $endTime = $dateHelper
            ->convertTimeHour($proposal->final_schedule_for_report->end_date);

        $thesisDefenceTime = $startTime . " - " . $endTime . " WITA";

        return view('news_reports.proposal', compact(
            'proposal',
            'todayDate',
            'finalProjectTitle',
            'thesisDefenceSchedule',
            'thesisDefenceTime'
        ));
    }
}
