<?php

namespace App\Http\Controllers;

use App\FinalLog;
use App\NewsReport;
use App\FinalStatus;
use App\NewsReportImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Requests\NewsReportImageRequest;
use Illuminate\Support\Facades\DB;

class NewsReportImageController extends Controller
{
    private $newsReportImage, $uploadHelper, $finalLog;

    public function __construct(NewsReportImage $newsReportImage, UploadHelper $uploadHelper, FinalLog $finalLog)
    {
        $this->newsReportImage = $newsReportImage;
        $this->uploadHelper = $uploadHelper;
        $this->finalLog = $finalLog;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsReportImageRequest $request)
    {

        $finalLogId = $this->finalLog->whereFinalProjectId($request->final_project_id)
            ->whereFinalStatusId(FinalStatus::name($request->final_status_name))
            ->first();

        if (!$finalLogId) {
            return response()->json("Failed");
        }

        $finalLogId = $finalLogId->id;

        $newsReport = new NewsReport;
        $newsReport->final_log_id = $finalLogId;

        $newsReport->save();

        try {
            if ($request->hasFile('news_report_images')) {
                foreach ($request->news_report_images as $newsReportImageFile) {
                    $newsReportImage = new NewsReportImage;
                    $filesName =  $this->uploadHelper->uploadFile(
                        $newsReportImageFile,
                        Str::random(40),
                        'news_report'
                    );

                    $newsReportImage->image = $filesName;
                    $newsReportImage->news_report_id = $newsReport->id;
                    $newsReportImage->save();
                }
            }
        } catch (\Throwable $th) {

            return response()->json("Failed");
        }
        return response()->json("Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\NewsReportImage  $newsReportImage
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $finalProjectId)
    {
        $finalStatusId = FinalStatus::name($request->query('finalStatusName'));

        return DB::table('final_logs')
            ->join('news_reports', 'final_logs.id', '=', 'news_reports.final_log_id')
            ->join('news_report_images', 'news_reports.id', '=', 'news_report_images.news_report_id')
            ->where([
                ['final_logs.final_status_id', '=', $finalStatusId],
                ['final_logs.final_project_id', '=', $finalProjectId],
            ])
            ->get();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsReportImage  $newsReportImage
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsReportImage $newsReportImage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsReportImage  $newsReportImage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsReportImage $newsReportImage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsReportImage  $newsReportImage
     * @return \Illuminate\Http\Response
     */
    public function destroy($newsReportImageId)
    {
        $newsReportImage = NewsReportImage::findOrFail($newsReportImageId);

        if ($newsReportImage->delete()) {
            return response()->json('Success');
        } else {
            return response()->json("Failed");
        }
    }
}
