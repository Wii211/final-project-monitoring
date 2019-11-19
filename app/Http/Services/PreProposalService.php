<?php

namespace App\Http\Services;

use App\User;
use App\FinalLog;
use App\Lecturer;
use App\Supervisor;
use App\FinalStatus;
use App\FinalProject;
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
        return $this->finalProject->with($relation)->whereFinalStudentId($id)->first();
    }

    public function submitWithRecomendationTitle(Request $request)
    {
        $finalStudentId = $this->finalStudent->getStudentId();

        $role = 1;

        if (!$this->lecturer->canPrimary($request->supervisors['lecturer_id'])) {
            $role = 2;
        }

        $supervisors = [];
        if ($request->type === "recommendation-title") {
            $supervisors = [
                'lecturer_id' => $request->supervisors['lecturer_id'],
                'role' => $role
            ];
        }

        try {
            DB::transaction(function () use ($request, $finalStudentId, $supervisors) {

                $finalProject = $this->finalProject;

                $finalProject->title = $request->title;
                $finalProject->final_student_id = $finalStudentId;
                $finalProject->description = $request->description;

                $finalProject->save();

                $recomendationTitle = $this->recomendationTitle
                    ->findOrFail($request->title_id);
                $recomendationTitle->final_student_id = $finalStudentId;

                $recomendationTitle->save();

                $finalLog = $this->finalLog;

                $finalLog->final_project_id = $finalProject->id;
                $finalLog->final_status_id = $this->finalStatus->name('pra-proposal');

                $finalLog->save();

                $finalProject->supervisors()->create($supervisors);
            });
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }



    public function submit(Request $request)
    {
        $finalStudentId = $this->finalStudent->getStudentId();

        try {
            DB::transaction(function () use ($request, $finalStudentId) {

                $finalProject = $this->finalProject;

                $finalProject->title = $request->title;
                $finalProject->final_student_id = $finalStudentId;
                $finalProject->description = $request->description;

                $finalProject->save();

                $finalLog = $this->finalLog;

                $finalLog->final_project_id = $finalProject->id;
                $finalLog->final_status_id = $this->finalStatus->name('pra-proposal');

                $finalLog->save();

                $finalProject->supervisors()->create($request->supervisors);
            });
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public function updateToProposal($finalProjectId)
    {
        try {
            $finalLog = $this->finalLog;
            $finalLog->final_project_id = $finalProjectId;
            $finalLog->final_status_id = $this->finalStatus->name('proposal');
            $finalLog->save();
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
