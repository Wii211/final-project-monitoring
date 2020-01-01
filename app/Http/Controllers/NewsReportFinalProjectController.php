<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\NewsReportService;

class NewsReportFinalProjectController extends Controller
{
    public function show(
        $finalProjectId,
        NewsReportService $newsReportService,
        Request $request
    ) {
        $finalProject = $newsReportService->generateReport(
            $finalProjectId,
            $request->status_name
        );

        return view('news_reports.final_project', $finalProject);
    }
}
