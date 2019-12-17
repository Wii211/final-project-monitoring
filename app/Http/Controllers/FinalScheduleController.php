<?php

namespace App\Http\Controllers;

use App\Examiner;
use App\FinalLog;
use App\FinalStatus;
use App\FinalSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FinalScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finalSchedule = FinalSchedule::with(['finalLog.finalProject.examiners', 'finalLog.finalStatus'])
            ->latest()->get();

        return response()->json(['data' => $finalSchedule]);
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
            DB::transaction(function () use ($request) {

                $finalProjectId = $request->final_project_id;

                $finalLogId = FinalLog::whereFinalProjectId($finalProjectId)
                    ->whereFinalStatusId(FinalStatus::name($request->status))->first()->id;

                $finalSchedule = new FinalSchedule([
                    'place' => $request->place,
                    'scheduled' => $request->scheduled,
                    'final_log_id' => $finalLogId
                ]);

                $finalSchedule->save();

                $examiners1 = new Examiner([
                    'role' => $request->examiner1['role'],
                    'lecturer_id' => $request->examiner1['lecturer_id'],
                    'final_project_id' => $finalProjectId
                ]);

                $examiners1->save();

                $examiners2 = new Examiner([
                    'role' => $request->examiner2['role'],
                    'lecturer_id' => $request->examiner2['lecturer_id'],
                    'final_project_id' => $finalProjectId
                ]);

                $examiners2->save();

                $examiners3 = new Examiner([
                    'role' => $request->examiner3['role'],
                    'lecturer_id' => $request->examiner3['lecturer_id'],
                    'final_project_id' => $finalProjectId
                ]);

                $examiners3->save();
            });
        } catch (\Throwable $th) {
            return response()->json("Failed");
        }
        return response()->json("Success");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinalSchedule  $finalSchedule
     * @return \Illuminate\Http\Response
     */
    public function show(FinalSchedule $finalSchedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinalSchedule  $finalSchedule
     * @return \Illuminate\Http\Response
     */
    public function edit(FinalSchedule $finalSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinalSchedule  $finalSchedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinalSchedule $finalSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinalSchedule  $finalSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinalSchedule $finalSchedule)
    {
        //
    }
}
