<?php

namespace App\Http\Controllers;

use App\FinalLog;
use App\Supervisor;
use Illuminate\Http\Request;

class FinalLogStudentController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($finalProjectId)
    {
        $finalLog = FinalLog::whereFinalProjectId($finalProjectId)
            ->with('finalStatus')->get();

        return response()->json(['data' => $finalLog]);
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
    public function update(Request $request, $id, Supervisor $supervisor)
    {
        $finalLog = FinalLog::FindOrFail($id);


        if ($supervisor->checkSupervisorsQuota(
            $finalLog->finalProject->supervisors[0]->id,
            1
        )) {
            return response()->json("Dosen Full");
        }

        $supervisor1 = $supervisor->findOrFail(
            $finalLog->finalProject->supervisors[0]->id
        );

        $supervisor1->is_agree = 1;
        $supervisor1->save();

        if (isset($finalLog->finalProject->supervisors[1])) {

            if ($supervisor->checkSupervisorsQuota(
                $finalLog->finalProject->supervisors[0]->id,
                2
            )) {
                return response()->json("Dosen Full");
            }

            $supervisor2 = $supervisor->findOrFail(
                $finalLog->finalProject->supervisors[1]->id
            );

            $supervisor2->is_agree = 1;
            $supervisor2->save();
        }

        $finalLog->is_verification = $request->is_verification;

        if ($finalLog->save()) {
            return response()->json("Success");
        } else {
            return response()->json("Failed");
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
