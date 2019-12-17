<?php

namespace App\Http\Controllers;

use App\FinalLog;
use App\FinalStatus;
use App\FinalProgress;
use Illuminate\Http\Request;

class FinalProgressController extends Controller
{
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
        try {

            $finalStatusId = FinalStatus::name($request->final_status);

            $finalProjectId = $request->final_project_id;

            $finalLogId = FinalLog::whereFinalStatusId($finalStatusId)
                ->whereFinalProjectId($finalProjectId)->first()->id;

            $finalProgress = new FinalProgress([
                'description' => $request->description,
                'final_log_id' => $finalLogId
            ]);
            $finalProgress->save();
        } catch (\Throwable $th) {
            return response()->json("Failed");
        }
        return response()->json("Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinalProgress  $finalProgress
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $finalProjectId)
    {
        try {
            //code...

            $finalStatusId = FinalStatus::name($request->final_status);

            $finalLogId = FinalLog::whereFinalStatusId($finalStatusId)
                ->whereFinalProjectId($finalProjectId)->first()->id;

            $finalProgress = FinalProgress::whereFinalLogId($finalLogId)->get();

            return response()->json(['data' => $finalProgress]);
        } catch (\Throwable $th) {
            return response()->json("failed");
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinalProgress  $finalProgress
     * @return \Illuminate\Http\Response
     */
    public function edit(FinalProgress $finalProgress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinalProgress  $finalProgress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $finalProgressId)
    {
        try {
            $finalProgress = FinalProgress::findOrFail($finalProgressId);
            $finalProgress->agreement = $request->agreement;
            $finalProgress->save();
        } catch (\Throwable $th) {
            return response()->json("failed");
        }
        return response()->json('Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinalProgress  $finalProgress
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            FinalProgress::destroy($id);
        } catch (\Throwable $th) {
            return response()->json('Failed');
        }
        return response()->json("Success");
    }
}
