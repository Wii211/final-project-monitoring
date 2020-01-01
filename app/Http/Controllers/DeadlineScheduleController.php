<?php

namespace App\Http\Controllers;

use App\Schedule;
use Illuminate\Http\Request;
use App\Http\Services\DeadLineScheduleService;

class DeadlineScheduleController extends Controller
{
    private $deadLineScheduleService;

    public function __construct(DeadLineScheduleService $deadLineScheduleService)
    {
        $this->deadLineScheduleService = $deadLineScheduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deadlineSchedule = $this->deadLineScheduleService->getListData();
        return view('coordinators.home', compact('deadlineSchedule'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //a
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->deadLineScheduleService->updateSchedules($request)) {
            return redirect()->back()->with('success', ['Success']);
        } else {
            return redirect()->back()->with('failed', ['Failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function show($schedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function edit($schedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // try {
        //     $this->deadLineScheduleService->updateData($request, $id);
        //     return response()->json("Success");
        // } catch (\Throwable $th) {
        //     return response()->json("Error " . $th);
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Schedule  $schedule
     * @return \Illuminate\Http\Response
     */
    public function destroy($schedule)
    {
        //
    }
}
