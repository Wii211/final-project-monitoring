<?php

namespace App\Http\Controllers;

use App\Http\Requests\LecturerRequest;
use Illuminate\Http\Request;
use App\Http\Services\LecturerService;

class LecturerController extends Controller
{

    private $lecturerService;

    public function __construct(LecturerService $lecturerService)
    {
        $this->lecturerService = $lecturerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $q = null;

        if ($request->has('primary')) $q = $request->query('primary');

        return $request->ajax() ? response()->json(
            ['data' =>
            $this->lecturerService->getListData(null, $q, null)]
        ) : view('datas.lecturer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LecturerRequest $request)
    {
        try {
            $this->lecturerService->storeData($request);
            return response()->json("Success");
        } catch (\Throwable $th) {
            return response()->json("Error " . $th);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->lecturerService->getData(['topics', 'position'], $id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function update(LecturerRequest $request, $id)
    {
        try {
            $this->lecturerService->updateData($request, $id);
            return response()->json("Success");
        } catch (\Throwable $th) {
            return response()->json("Error " . $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lecturer  $lecturer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->lecturerService->doNonActive($id);
            return response()->json("Success");
        } catch (\Throwable $th) {
            return response()->json("Error " . $th);
        }
    }
}
