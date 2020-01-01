<?php

namespace App\Http\Controllers;

use App\Examiner;
use App\FinalLog;
use Carbon\Carbon;
use App\FinalStatus;
use App\FinalSchedule;
use App\Http\Resources\FinalScheduleCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FinalScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finalSchedule = FinalSchedule::with([
            'finalLog.finalProject.examiners.lecturer',
            'finalLog.finalStatus', 'finalLog.finalProject.finalStudent'
        ])
            ->latest()->get();

        return new FinalScheduleCollection($finalSchedule);
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
        $finalProjectId = $request->final_project_id;

        $finalLogId = FinalLog::whereFinalProjectId($finalProjectId)
            ->whereFinalStatusId(FinalStatus::name($request->status))->first()->id;

        $finalSchedule = FinalSchedule::whereFinalLogId($finalLogId)->first();

        if ($finalSchedule) {
            return response()->json("Anda Telah Menetapkan Jadwal");
        }


        try {
            DB::transaction(function () use ($request, $finalProjectId, $finalLogId) {
                $date = $request->date . " " . $request->time;

                $time = FinalSchedule::convertTime($date);

                $finalSchedule = new FinalSchedule([
                    'place' => $request->place,
                    'scheduled' => $time,
                    'final_log_id' => $finalLogId
                ]);

                $finalSchedule->save();

                $examiners1 = new Examiner([
                    'role' => $request->examiner1['role'],
                    'lecturer_id' => $request->examiner1['lecturer_id'],
                    'final_project_id' => $finalProjectId,
                    'final_status_id' => FinalStatus::name($request->status)
                ]);

                $examiners1->save();

                $examiners2 = new Examiner([
                    'role' => $request->examiner2['role'],
                    'lecturer_id' => $request->examiner2['lecturer_id'],
                    'final_project_id' => $finalProjectId,
                    'final_status_id' => FinalStatus::name($request->status)
                ]);

                $examiners2->save();

                if ($request->status === 'tugas_akhir') {
                    $examiners3 = new Examiner([
                        'role' => $request->examiner3['role'],
                        'lecturer_id' => $request->examiner3['lecturer_id'],
                        'final_project_id' => $finalProjectId,
                        'final_status_id' => FinalStatus::name($request->status)
                    ]);

                    $examiners3->save();
                }
            });
        } catch (\Throwable $th) {
            dd($th);
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
    public function show($finalScheduleId)
    {
        $finalSchedule = FinalSchedule::with([
            'finalLog.finalProject.examiners',
            'finalLog.finalStatus', 'finalLog.finalProject.finalStudent'
        ])->findOrFail($finalScheduleId);

        return response()->json($finalSchedule);
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
    public function update(Request $request, $finalScheduleId)
    {
        try {
            DB::transaction(function () use ($request, $finalScheduleId) {

                $finalProjectId = $request->final_project_id;

                $date = $request->date . " " . $request->time;

                $time = FinalSchedule::convertTime($date);

                $finalLogId = FinalLog::whereFinalProjectId($finalProjectId)
                    ->whereFinalStatusId(FinalStatus::name($request->status))->first()->id;

                $finalSchedule =  FinalSchedule::findOrFail($finalScheduleId)
                    ->update([
                        'place' => $request->place,
                        'scheduled' => $time,
                        'final_log_id' => $finalLogId
                    ]);

                $examiners1 = Examiner::findOrFail($request->examiner1['id'])
                    ->update([
                        'role' => $request->examiner1['role'],
                        'lecturer_id' => $request->examiner1['lecturer_id'],
                        'final_project_id' => $finalProjectId,
                        'final_status_id' => FinalStatus::name($request->status)
                    ]);

                $examiners2 = Examiner::findOrFail($request->examiner2['id'])
                    ->update([
                        'role' => $request->examiner2['role'],
                        'lecturer_id' => $request->examiner2['lecturer_id'],
                        'final_project_id' => $finalProjectId,
                        'final_status_id' => FinalStatus::name($request->status)
                    ]);

                $examiners3 = Examiner::findOrFail($request->examiner3['id'])
                    ->update([
                        'role' => $request->examiner3['role'],
                        'lecturer_id' => $request->examiner3['lecturer_id'],
                        'final_project_id' => $finalProjectId,
                        'final_status_id' => FinalStatus::name($request->status)
                    ]);
            });
        } catch (\Throwable $th) {
            return response()->json("Failed");
        }
        return response()->json("Success");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinalSchedule  $finalSchedule
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $finalScheduleId)
    {
        try {
            DB::transaction(function () use ($request, $finalScheduleId) {
                FinalSchedule::destroy($finalScheduleId);

                $finalProjectId = $request->final_project_id;

                $examiners = Examiner::whereFinalProjectId($finalProjectId)->delete();
            });
        } catch (\Throwable $th) {
            return response()->json("Failed");
        }
        return response()->json("Success");
    }
}
