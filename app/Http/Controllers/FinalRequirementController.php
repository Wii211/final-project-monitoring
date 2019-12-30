<?php

namespace App\Http\Controllers;

use App\FinalLog;
use App\User;
use App\FinalRequirement;
use App\FinalStatus;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Requests\FinalRequirementRequest;

class FinalRequirementController extends Controller
{

    private $uploadHelper;

    public function __construct(UploadHelper $uploadHelper)
    {
        $this->uploadHelper = $uploadHelper;
    }

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
    public function store(FinalRequirementRequest $request)
    {

        $finalRequirement = new FinalRequirement;

        if ($request->hasFile('document_result')) {

            $name = User::getName() . " " . $request->final_status_name;

            $documentResultName = $this->uploadHelper->uploadFile(
                $request->file('document_result'),
                $name,
                'document_result'
            );

            $finalRequirement->document_result = $documentResultName;
        }

        $finalRequirement->final_log_id = $request->final_log_id;

        if ($finalRequirement->save()) {
            return response()->json("Success");
        } else {
            return response()->json("Failed");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        try {
            $finalLog = FinalLog::whereFinalProjectId($request->final_project_id)
                ->whereFinalStatusId(FinalStatus::name($request->final_status_name))
                ->first();

            $finalRequirement = FinalRequirement::whereFinalLogId($finalLog->id)
                ->first();

            return response()->json($finalRequirement);
        } catch (\Throwable $th) {
            return response()->json("Failed");
        }
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
