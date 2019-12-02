<?php

namespace App\Http\Controllers;

use App\Supervisor;
use App\FinalProject;
use App\FinalStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Services\PreProposalService;

class FinalProjectDataController extends Controller
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
        $data = FinalProject::with('finalStudent')->get();

        return response()->json(['data' => $data]);
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
        try {
            DB::transaction(function () use ($request) {
                $finalProject = new FinalProject([
                    'title' => $request->title,
                    'final_student_id' => $request->final_student_id,
                    'description' => $request->description
                ]);

                $finalProject->save();

                $supervisor1 = new Supervisor([
                    'role' => $request->supervisor['role'],
                    'final_project_id' => $finalProject->id,
                    'lecturer_id' => $request->supervisor['lecturer_id']
                ]);

                $supervisor1->save();

                $supervisor2 = new Supervisor([
                    'role' => $request->superviso2['role'],
                    'final_project_id' => $finalProject->id,
                    'lecturer_id' => $request->superviso2['lecturer_id']
                ]);
                $supervisor2->save();
            });
        } catch (\Throwable $th) {
            return response()->json("Success");
        }
        return response()->json("Failed");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = FinalProject::with('finalStudent', 'supervisors')->findOrFail($id);

        return response()->json(['data' => $data]);
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
        try {
            DB::transaction(function () use ($request, $id) {
                $finalProject = FinalProject::findOrFail($id);

                $finalProject->title = $request->title;
                $finalProject->final_student_id = $request->final_student_id;
                $finalProject->description = $request->description;

                $finalProject->save();

                $supervisor1 = new Supervisor([
                    'role' => $request->supervisor['role'],
                    'final_project_id' => $finalProject->id,
                    'lecturer_id' => $request->supervisor['lecturer_id']
                ]);

                $supervisor1->save();

                $supervisor2 = new Supervisor([
                    'role' => $request->superviso2['role'],
                    'final_project_id' => $finalProject->id,
                    'lecturer_id' => $request->superviso2['lecturer_id']
                ]);
                $supervisor2->save();
            });
        } catch (\Throwable $th) {
            return response()->json("Success");
        }
        return response()->json("Failed");
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
