<?php

namespace App\Http\Controllers;

use App\FinalLog;
use App\FinalSchedule;
use Illuminate\Http\Request;

class FinalScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finalSchedule = FinalSchedule::with(['finalLog.finalProject.examiners'])
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
        //
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
