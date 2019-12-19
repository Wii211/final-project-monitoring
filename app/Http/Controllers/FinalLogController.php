<?php

namespace App\Http\Controllers;

use App\FinalLog;
use App\FinalStatus;
use Illuminate\Http\Request;

class FinalLogController extends Controller
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
        $finalLog = new FinalLog([
            'final_project_id' => $request->final_project_id,
            'final_status_id' => FinalStatus::name($request->status),
            'is_verification' => 0
        ]);

        if ($finalLog->save()) {
            return response()->json("Success");
        } else {
            return response()->json("Failed");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinalLog  $finalLog
     * @return \Illuminate\Http\Response
     */
    public function show(FinalLog $finalLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinalLog  $finalLog
     * @return \Illuminate\Http\Response
     */
    public function edit(FinalLog $finalLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinalLog  $finalLog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinalLog $finalLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinalLog  $finalLog
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinalLog $finalLog)
    {
        //
    }
}
