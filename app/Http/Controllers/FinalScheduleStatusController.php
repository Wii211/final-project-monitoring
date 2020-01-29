<?php

namespace App\Http\Controllers;

use App\FinalLog;
use App\FinalSchedule;
use App\FinalStatus;
use Illuminate\Http\Request;

class FinalScheduleStatusController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Accept finalSchedule
        try {
            $finalSchedule = FinalSchedule::whereFinalLogId($request->final_log_id)
                ->first();
            $finalSchedule->status = 1;
            $finalSchedule->save();
        } catch (\Throwable $th) {
            return response()->json("Failed");
        }
        return response()->json("Success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        //Decline finalSchedule
        //Accept finalSchedule
        try {
            $finalStatusId = FinalLog::findOrFail($request->final_log_id)->final_status_id;


            $finalSchedule = FinalSchedule::whereFinalLogId($request->final_log_id)
                ->first();
            $finalSchedule->status = 2;
            $finalSchedule->save();

            if ($finalStatusId === FinalStatus::name('proposal')) {
                FinalSchedule::whereFinalLogId($request->final_log_id)->delete();
                FinalLog::destroy($request->final_log_id);
            }
        } catch (\Throwable $th) {
            dd($th);
            return response()->json("Failed");
        }
        return response()->json("Success");
    }
}
