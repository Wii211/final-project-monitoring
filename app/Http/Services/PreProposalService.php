<?php

namespace App\Http\Services;

use App\FinalLog;
use App\Supervisor;
use App\FinalProject;
use App\FinalStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PreProposalService
{
    private $finalProject, $finalStudent, $finalLog;

    public function __construct(
        FinalProject $finalProject,
        FinalStudent $finalStudent,
        FinalLog $finalLog
    ) {
        $this->finalProject = $finalProject;
        $this->finalStudent = $finalStudent;
        $this->finalLog = $finalLog;
    }

    public function getData($id, $relation)
    {
        return $this->finalProject->with($relation)->findOrFail($id);
    }

    public function submit(Request $request)
    {
        $finalStudentId = $this->finalStudent->getStudentId();


        try {
            DB::transaction(function () use ($request, $finalStudentId) {

                $finalProject = $this->finalProject;

                $finalProject->title = $request->title;
                $finalProject->final_student_id = $finalStudentId;

                $finalProject->save();

                $finalLog = $this->finalLog;

                $finalLog->final_project_id = $finalProject->id;
                $finalLog->final_status_id = 1;

                $finalLog->save();

                $finalProject->supervisors()->create($request->supervisors);
            });
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
