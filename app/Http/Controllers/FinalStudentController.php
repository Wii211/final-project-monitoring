<?php

namespace App\Http\Controllers;

use App\FinalStudent;
use App\Http\Services\FinalStudentService;
use Illuminate\Http\Request;

class FinalStudentController extends Controller
{
    private $studentService;

    public function __construct(FinalStudentService $studentService)
    {
        $this->studentService = $studentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $request->ajax() ? response()->json(
            ['data' => $this->studentService->getListData('user', null, null, 'name')]
        )
            : view('datas.student');
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
        if ($this->studentService->store($request)) {
            return response()->json("success");
        } else {
            return response()->json('Failed');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinalStudent  $finalStudent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return response()->json($this->studentService->getData(['user'], $id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\FinalStudent  $finalStudent
     * @return \Illuminate\Http\Response
     */
    public function edit(FinalStudent $finalStudent)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\FinalStudent  $finalStudent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($this->studentService->update($request, $id)) {
            return response()->json("sucess");
        } else {
            return response()->json('false');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\FinalStudent  $finalStudent
     * @return \Illuminate\Http\Response
     */
    public function destroy(FinalStudent $finalStudent)
    {
        //
    }
}
