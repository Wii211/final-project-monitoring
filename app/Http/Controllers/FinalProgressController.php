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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinalProgress  $finalProgress
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $finalProjectId)
    {
        $finalStatusId = FinalStatus::name($request->final_status);

        $finalLogId = FinalLog::whereFinalStatusId($finalStatusId)
            ->whereFinalProjectId($finalProjectId)->first->id;

        $finalProgress = FinalProgress::whereFinalLogId($finalLogId)->get();

        return response()->json(['data' => $finalProgress]);
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
    public function update(Request $request, FinalProgress $finalProgress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinalProgress  $finalProgress
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinalProgress $finalProgress)
    {
        //
    }
}
