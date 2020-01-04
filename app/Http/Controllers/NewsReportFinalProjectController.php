<?php

namespace App\Http\Controllers;

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

        return view('news_reports.final_project', compact(
            'finalProject',
            'todayDate',
            'finalProjectTitle'
        ));
    }
}
