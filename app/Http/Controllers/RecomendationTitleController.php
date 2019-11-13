<?php

namespace App\Http\Controllers;

use App\Http\Services\RecomendationTitleService;
use App\RecomendationTitle;
use Illuminate\Http\Request;

class RecomendationTitleController extends Controller
{
    private $recomendationTitleService;

    public function __construct(RecomendationTitleService $recomendationTitleService)
    {
        $this->recomendationTitleService = $recomendationTitleService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = null;

        if ($request->has('q')) $q = $request->query('q');

        return view(
            'recommendations.titles',
            ['recomendationTitles' => $this->recomendationTitleService->getListData($q)]
        );
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
        if ($this->recomendationTitleService->storeData($request)) {
            return redirect()->back()->with('success', ['Success']);
        } else {
            return redirect()->back()->with('failed', ['Failed']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\RecomendationTitle  $recomendationTitle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        return response()->json($this->recomendationTitleService->getData($id));
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
    public function update(Request $request, $id)
    {
        if ($this->recomendationTitleService->updateData($request, $id)) {
            return redirect()->back()->with('success', ['Success']);
        } else {
            return redirect()->back()->with('failed', ['Failed']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecomendationTitle  $recomendationTitle
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if ($this->recomendationTitleService->deleteData($id)) {
            return redirect()->back()->with('success', ['Success']);
        } else {
            return redirect()->back()->with('failed', ['Failed']);
        }
    }
}
