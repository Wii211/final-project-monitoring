<?php

namespace App\Http\Controllers;

use App\User;

use App\FinalLog;
use App\FinalStatus;
use App\FinalStudent;
use Illuminate\Http\Request;
use App\Http\Services\PreProposalService;

class PreProposalController extends Controller
{
    private $preProposalService, $finalStudent, $finalStatus;

    public function __construct(
        PreProposalService $preProposalService,
        FinalStudent $finalStudent,
        FinalStatus $finalStatus
    ) {
        $this->preProposalService = $preProposalService;
        $this->finalStudent = $finalStudent;
        $this->finalStatus = $finalStatus;
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
                'finalLogsPraProposal.finalStatus',
                'supervisors.lecturer'
            ]);

        $status = "";

        if (!is_null($data)) {
            if (FinalLog::statusProposal($data->id)) {
                $status = "proposal";
            }
        }

        return view('students.pre_proposal', compact('data', 'status'));
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

        if ($request->has('title_id')) {
            if ($this->preProposalService->checkDuplicate()) {
                return redirect()->back()->with('duplicate', ['Duplicate']);
            }
            if ($this->preProposalService->submitWithRecomendationTitle($request)) {
                return redirect()->back()->with('success', ['Success']);
            } else {
                return redirect()->back()->with('failed', ['Failed']);
            }
        } else {
            if ($this->preProposalService->submit($request)) {

                return response()->json("Success");
            } else {
                return response()->json('Failed');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->preProposalService
            ->getData($this->finalStudent->getStudentId(), [
                'finalLogsPraProposal.finalStatus',
                'supervisors'
            ]);
        return response()->json($data);
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
        if ($request->has('title')) {
            if ($this->preProposalService->update($id, $request)) {
                return response()->json("Success");
            } else {
                return response()->json('Failed');
            }
        } else {

            if ($this->preProposalService->updateToProposal($id)) {
                return redirect()->back()->with('success', ['Success']);
            } else {
                return redirect()->back()->with('failed', ['Failed']);
            }
        }
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
