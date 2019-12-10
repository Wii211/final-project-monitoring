<?php

namespace App\Http\Controllers;

use App\FinalStatus;
use App\NewsReportImage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\NewsReport;
use Illuminate\Support\Facades\DB;

class NewsReportImageController extends Controller
{
    private $newsReportImage, $uploadHelper;

    public function __construct(NewsReportImage $newsReportImage, UploadHelper $uploadHelper)
    {
        $this->newsReportImage = $newsReportImage;
        $this->uploadHelper = $uploadHelper;
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
    public function store(Request $request)
    {
        $newsReportImage = $this->newsReportImage;

        $filesName = [];

        try {
            if ($request->hasFile('news_report_images')) {
                foreach ($request->news_report_images as $key => $newsReportImage) {
                    $filesName[] = [
                        'name' => $this->uploadHelper->uploadFile(
                            $request->file('image_profile'),
                            Str::random(40),
                            'news_report'
                        )
                    ];
                }

                $newsReportImage->image = $filesName;
                $newsReportImage->news_report_id = $request->news_report_id;
                $newsReportImage->save();
            }
        } catch (\Throwable $th) {
            //throw $th;
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
