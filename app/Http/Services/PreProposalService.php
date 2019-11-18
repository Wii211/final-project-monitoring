<?php

namespace App\Http\Services;

use App\FinalLog;
use App\Supervisor;
use App\FinalProject;
use App\FinalStatus;
use App\FinalStudent;
use App\RecomendationTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PreProposalService
{
    private $finalProject, $finalStudent, $finalLog, $recomendationTitle,
        $finalStatus, $lecturer;

    public function __construct(
        FinalProject $finalProject,
        FinalStudent $finalStudent,
        FinalLog $finalLog,
        RecomendationTitle $recomendationTitle,
        FinalStatus $finalStatus,
        Lecturer $lecturer
    ) {
        $this->finalProject = $finalProject;
        $this->finalStudent = $finalStudent;
        $this->finalLog = $finalLog;
        $this->recomendationTitle = $recomendationTitle;
        $this->finalStatus = $finalStatus;
        $this->lecturer = $lecturer;
    }

    public function getData($id, $relation)
    {
        return $this->finalProject->with($relation)->findOrFail($id);
    }

    public function submit(Request $request)
    {
        $finalStudentId = $this->finalStudent->getStudentId();

        $role = 1;

        if (!$this->lecturer->canPrimary($request->supervisors)) {
            $role = 2;
        }

        $supervisors = [];
        if ($request->type === "recommendation-title") {
            $supervisors = [
                'lecturer_id' => $request->supervisors,
                'role' => $role
            ];
        }

        try {
            DB::transaction(function () use ($request, $finalStudentId, $supervisors) {

                $finalProject = $this->finalProject;

                $finalProject->title = $request->title;
                $finalProject->final_student_id = $finalStudentId;

                $finalProject->save();

                $recomendationTitle = $this->recomendationTitle
                    ->findOrFail($request->title_id);
                $recomendationTitle->final_student_id = $finalStudentId;

                $recomendationTitle->save();

                $finalLog = $this->finalLog;

                $finalLog->final_project_id = $finalProject->id;
                $finalLog->final_status_id = $this->finalStatus->name('pendaftaran');

                $finalLog->save();

                $finalProject->supervisors()->create($supervisors);
            });
        } catch (\Throwable $th) {
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
