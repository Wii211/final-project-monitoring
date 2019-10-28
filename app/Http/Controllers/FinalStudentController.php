<?php

namespace App\Http\Controllers;

use App\FinalStudent;
use Illuminate\Http\Request;

class FinalStudentController extends Controller
{

    private $student;
    public function __construct(FinalStudent $student)
    {
        $this->student = $student;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\FinalStudent  $finalStudent
     * @return \Illuminate\Http\Response
     */
    public function show(FinalStudent $finalStudent)
    {
        //
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
    public function update(Request $request, FinalStudent $finalStudent)
    {
        //
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
