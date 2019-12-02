<?php

namespace App\Http\Controllers;

use App\NewsReport;
use App\FinalStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    { }

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
     * @param  \App\NewsReport  $newsReport
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $finalProjectId)
    { }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\NewsReport  $newsReport
     * @return \Illuminate\Http\Response
     */
    public function edit(NewsReport $newsReport)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\NewsReport  $newsReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, NewsReport $newsReport)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\NewsReport  $newsReport
     * @return \Illuminate\Http\Response
     */
    public function destroy(NewsReport $newsReport)
    { }
}
