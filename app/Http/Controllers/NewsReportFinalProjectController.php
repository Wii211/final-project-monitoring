<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\FinalProject;
use App\Helpers\DateHelper;
use Illuminate\Http\Request;
use App\Http\Services\NewsReportService;

class NewsReportFinalProjectController extends Controller
{
    public function show(
        $finalProjectId,
        NewsReportService $newsReportService,
        Request $request,
        DateHelper $dateHelper
    ) {
        $finalProject = $newsReportService->generateReport(
            $finalProjectId,
            'tugas_akhir'
        );

        $finalProjectTitle = FinalProject::convertTitleForNewsReport(
            $finalProject->finalProject->title
        );

        $todayDate = $dateHelper->getTodayDate();

        $finalProjectTitle = FinalProject::convertTitleForNewsReport(
            $finalProject->finalProject->title
        );

        $thesisDefenceSchedule = $dateHelper->formatDateWithDayName(
            Carbon::parse(
                $finalProject->finalScheduleForReport->scheduled
            ) 
        );
        
        $thesisDate =  $dateHelper->formatDate(
            Carbon::parse(
                $finalProject->finalScheduleForReport->scheduled
            ) 
        );

        $startTime = $dateHelper
            ->convertTimeHour($finalProject->finalScheduleForReport->scheduled);

        $endTime = $dateHelper
            ->convertTimeHour($finalProject->finalScheduleForReport->end_date);

        $thesisDefenceTime = $startTime . " - " . $endTime . " WITA";

        return view('news_reports.final_project', compact(
            'finalProject',
            'todayDate',
            'finalProjectTitle',
            'thesisDefenceSchedule',
            'thesisDefenceTime',
            'thesisDate'
        ));
    }
}
