<?php

namespace App\Http\Controllers;

use App\FinalLog;
use App\FinalProject;
use App\FinalStatus;
use App\FinalStudent;
use Illuminate\Http\Request;
use App\Http\Services\PreProposalService;

class FinalProjectController extends Controller
{
    private $preProposalService, $finalStudent;

    public function __construct(
        PreProposalService $preProposalService,
        FinalStudent $finalStudent
    ) {
        $this->preProposalService = $preProposalService;
        $this->finalStudent = $finalStudent;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->preProposalService
            ->getData($this->finalStudent->getStudentId(), [
                'finalLogs.finalSchedules',
                'finalLogs.finalStatus',
                'supervisors.lecturer'
            ]);

        return view('students.final_project', compact('data'));
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
     * @param  \App\FinalProject  $finalProject
     * @return \Illuminate\Http\Response
     */
    public function show(FinalProject $finalProject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinalProject  $finalProject
     * @return \Illuminate\Http\Response
     */
    public function edit(FinalProject $finalProject)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinalProject  $finalProject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FinalProject $finalProject)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinalProject  $finalProject
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinalProject $finalProject)
    {
        //
    }
}
