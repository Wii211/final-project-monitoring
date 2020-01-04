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
        Request $request
    ) {
        $proposal = $newsReportService->generateReport(
            $finalProjectId,
            'proposal'
        );

        $todayDate = DateHelper::getTodayDate();

        $finalProjectTitle = FinalProject::convertTitleForNewsReport(
            $proposal->finalProject->title
        );

        return view('news_reports.proposal', compact(
            'proposal',
            'todayDate',
            'finalProjectTitle'
        ));
    }
}
