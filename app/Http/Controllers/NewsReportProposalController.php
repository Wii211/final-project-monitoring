<?php

namespace App\Http\Controllers;

use App\FinalLog;
use App\FinalStatus;
use App\FinalProject;
use App\Http\Services\NewsReportService;
use Illuminate\Http\Request;

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

        $todayDate = $newsReportService->getTodayDate();


        return view('news_reports.proposal', compact('proposal', 'todayDate'));
    }
}
