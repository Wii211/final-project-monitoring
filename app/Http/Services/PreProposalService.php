<?php

namespace App\Http\Services;

use App\FinalLog;
use App\Supervisor;
use App\FinalProject;
use App\FinalStudent;
use App\RecomendationTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PreProposalService
{
    private $finalProject, $finalStudent, $finalLog, $recomendationTitle;

    public function __construct(
        FinalProject $finalProject,
        FinalStudent $finalStudent,
        FinalLog $finalLog,
        RecomendationTitle $recomendationTitle
    ) {
        $this->finalProject = $finalProject;
        $this->finalStudent = $finalStudent;
        $this->finalLog = $finalLog;
        $this->recomendationTitle = $recomendationTitle;
    }

    public function getData($id, $relation)
    {
        return $this->finalProject->with($relation)->findOrFail($id);
    }

    public function submit(Request $request)
    {
        $finalStudentId = $this->finalStudent->getStudentId();

        $supervisors = [];
        if ($request->type === "recommendation-title") {
            $supervisors = [
                'lecturer_id' => $request->supervisors[0],
                'role' => $request->supervisors[1]
            ];
        }

        try {
            DB::transaction(function () use ($request, $finalStudentId, $supervisors) {

                $finalProject = $this->finalProject;

                $finalProject->title = $request->title;
                $finalProject->final_student_id = $finalStudentId;

                $finalProject->save();

                $recomendationTitle = $this->recomendationTitle->findOrFail($request->title_id);
                $recomendationTitle->final_student_id = $finalStudentId;

                $recomendationTitle->save();

                $finalLog = $this->finalLog;

                $finalLog->final_project_id = $finalProject->id;
                $finalLog->final_status_id = 1;

                $finalLog->save();

                $finalProject->supervisors()->create($supervisors);
            });
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }
        return true;
    }

    public function checkDuplicate()
    {
        $finalStudentId = $this->finalStudent->getStudentId();

        if ($this->recomendationTitle->checkIfSubmited($finalStudentId)) {
            return true;
        } else {
            return false;
        }
    }
}
