<?php

namespace App\Http\Controllers;

use App\FinalStudent;
use Illuminate\Http\Request;
use App\Http\Services\FinalStudentService;
use App\Http\Services\FinalRegistrationService;

class FinalStudentVerifyController extends Controller
{
    private $finalStudentService, $finalRegistrationService;

    public function __construct(
        FinalStudentService $finalStudentService,
        FinalRegistrationService $finalRegistrationService
    ) {
        $this->finalStudentService = $finalStudentService;
        $this->finalRegistrationService = $finalRegistrationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $verify = null;

        if ($request->has('verify')) $verify = $request->query('verify');

        return $request->ajax() ?  response()->json(
            ['data' => $this->finalStudentService
                ->getListData('user', 1, $verify, 'transcript')]
        ) : view('final_projects.students');
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
    public function show($id, Request $request)
    {
        $finalStudent = FinalStudent::active(1)->findOrFail($id);

        return response()->json($finalStudent);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if ($this->finalRegistrationService->verifyFinalStudent($id)) {
            return response()->json("Success");
        } else {
            return response()->json("Error");
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
        if ($this->finalRegistrationService->unverifyFinalStudent($id)) {
            return response()->json("Success");
        } else {
            return response()->json("Error");
        }
    }
}
