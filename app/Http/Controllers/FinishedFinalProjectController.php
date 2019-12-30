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
        if ($request->has('status')) $status = $request->query('status');


        $finalProject = FinalProject::whereHas('finalLogs', function ($query) use ($status) {
            $query->whereHas('finalRequirements', function ($query) {
            });
            $query->whereFinalStatusId(FinalStatus::name($status));
            $query->whereIsVerification(1);
        })->with(['finalLogs' => function ($query) use ($status) {
            $query->whereFinalStatusId(FinalStatus::name($status));
            $query->whereHas('finalRequirements');
            $query->with('finalRequirements');
        }])
            ->get();

        return response()->json($finalProject);
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
