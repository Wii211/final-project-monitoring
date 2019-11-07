<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Services\DeadLineScheduleService;
use App\Http\Requests\FinalRegistrasionRequest;
use App\Http\Services\FinalRegistrationService;

class FinalRegistrationController extends Controller
{

    private $finalRegistrationService, $deadLineScheduleService;

    public function __construct(
        FinalRegistrationService $finalRegistrationService,
        DeadLineScheduleService $deadLineScheduleService
    ) {
        $this->finalRegistrationService = $finalRegistrationService;
        $this->deadLineScheduleService = $deadLineScheduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $endDateAndDiffDate = $this->deadLineScheduleService->showProposalRegisterDeadLine();

        return view('students.home', compact('endDateAndDiffDate'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FinalRegistrasionRequest $request)
    {

        if ($this->finalRegistrationService->registerFinal($request)) {
            return redirect('student')->with('message', 'Success');
        } else
            return redirect('student')->with('message', 'Failed');
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
