<?php

namespace App\Http\Controllers;

use App\FinalStatus;
use App\FinalProject;
use Illuminate\Http\Request;

class FinishedFinalProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //ready for presents Final Project

        $status = 'tugas_akhir';

        $verification = 1;

        if ($request->has('status'))
            $status = $request->query('status');

        if ($request->has('verification')) $verification =
            $request->query('verification');


        $finalProject = FinalProject::whereHas(
            'finalLogs',
            function ($query) use ($status, $verification) {
                $query->whereHas('finalRequirements', function ($query) {
                });
                $query->whereDoesntHave('finalSchedules');
                $query->where('final_status_id', '!=', FinalStatus::name('tugas_akhir_selesai'));
                $query->whereFinalStatusId(FinalStatus::name($status));
                $query->whereIsVerification($verification);
            }
        )->with(['finalLogs' => function ($query) use ($status) {
            $query->whereFinalStatusId(FinalStatus::name($status));
            $query->where('final_status_id', '!=', FinalStatus::name('tugas_akhir_selesai'));
            $query->whereDoesntHave('finalSchedules');
            $query->whereHas('finalRequirements');
            $query->with('finalRequirements');
        }, 'finalStudent'])
            ->get();

        return response()->json(['data' => $finalProject]);
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
    public function show($id, Request $request)
    {
        //ready for presents Final Project

        $status = 'tugas_akhir';

        $verification = 1;

        if ($request->has('status'))
            $status = $request->query('status');

        if ($request->has('verification')) $verification =
            $request->query('verification');

        try {
            $finalProject = FinalProject::whereHas(
                'finalLogs',
                function ($query) use ($status, $verification) {
                    $query->whereHas('finalRequirements', function ($query) {
                    });
                    $query->whereDoesntHave('finalSchedules');
                    $query->where('final_status_id', '!=', FinalStatus::name('tugas_akhir_selesai'));
                    $query->whereFinalStatusId(FinalStatus::name($status));
                    $query->whereIsVerification($verification);
                }
            )->with(['finalLogs' => function ($query) use ($status) {
                $query->whereFinalStatusId(FinalStatus::name($status));
                $query->where('final_status_id', '!=', FinalStatus::name('tugas_akhir_selesai'));
                $query->whereDoesntHave('finalSchedules');
                $query->whereHas('finalRequirements');
                $query->with('finalRequirements');
            }, 'finalStudent'])
                ->findOrFail($id);
        } catch (\Throwable $th) {
            return response()->json(['data' => 0]);
        }


        return response()->json(['data' => 1]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
