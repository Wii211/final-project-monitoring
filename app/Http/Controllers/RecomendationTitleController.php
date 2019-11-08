<?php

namespace App\Http\Controllers;

use App\RecomendationTitle;
use Illuminate\Http\Request;

class RecomendationTitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('recommendations.titles');
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
     * @param  \App\RecomendationTitle  $recomendationTitle
     * @return \Illuminate\Http\Response
     */
    public function show(RecomendationTitle $recomendationTitle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\RecomendationTitle  $recomendationTitle
     * @return \Illuminate\Http\Response
     */
    public function edit(RecomendationTitle $recomendationTitle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\RecomendationTitle  $recomendationTitle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RecomendationTitle $recomendationTitle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecomendationTitle  $recomendationTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy(RecomendationTitle $recomendationTitle)
    {
        //
    }
}
