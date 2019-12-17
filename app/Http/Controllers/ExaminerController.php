<?php

namespace App\Http\Controllers;

use App\Examiner;
use App\Lecturer;
use App\Supervisor;
use Illuminate\Http\Request;

class ExaminerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $projectId = null;
        $primary = null;

        if ($request->has('projectId')) $projectId = $request->query('projectId');
        if ($request->has('primary')) $primary = $request->query('primary');

        $supervisors = Supervisor::whereFinalProjectId($projectId)->get();

        $lecturerId = [];

        foreach ($supervisors as $supervisor) {
            $lecturerId[] = [$supervisor->lecturer_id];
        }

        $lecturers = Lecturer::whereNotIn('id', $lecturerId);

        if ($primary === 'true') {
            $lecturers = $lecturers->primary($primary);
        }

        return response()->json($lecturers->get());
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
     * @param  \App\Examiner  $examiner
     * @return \Illuminate\Http\Response
     */
    public function show(Examiner $examiner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Examiner  $examiner
     * @return \Illuminate\Http\Response
     */
    public function edit(Examiner $examiner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Examiner  $examiner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Examiner $examiner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Examiner  $examiner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Examiner $examiner)
    {
        //
    }
}
