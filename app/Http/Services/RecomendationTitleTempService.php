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
use App\RecomendationTitleTemp;
use Illuminate\Support\Facades\DB;
use App\Http\Services\RecomendationTitleService;

class RecomendationTitleTempService
{
    private $recomendationTitle, $titleTemp, $finalStudent,
        $lecturer, $supervisor, $finalProject, $recomendationTitleService;

    public function __construct(
        RecomendationTitle $recomendationTitle,
        RecomendationTitleTemp $titleTemp,
        FinalStudent $finalStudent,
        Lecturer $lecturer,
        FinalProject $finalProject,
        Supervisor $supervisor,
        RecomendationTitleService $recomendationTitleService
    ) {
        $this->recomendationTitle = $recomendationTitle;
        $this->titleTemp = $titleTemp;
        $this->finalStudent = $finalStudent;
        $this->lecturer = $lecturer;
        $this->finalProject = $finalProject;
        $this->supervisor = $supervisor;
        $this->recomendationTitleService = $recomendationTitleService;
    }

    public function requestTitle(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $recomendationTitle = $this->recomendationTitle
                    ->findOrFail($request->title_id);

                $recomendationTitle->final_student_id =
                    $this->finalStudent->getStudentId();

                $role = "";

                if ($this->lecturer->canPrimary($recomendationTitle->lecturer_id)) {
                    $role = 1;
                } else {
                    $role = 2;
                }

                if ($this->supervisor
                    ->checkSupervisorsQuota($recomendationTitle->lecturer_id, $role)
                ) {
                    return "full";
                }

                $recomendationTitle->save();

                $titleTemp = $this->titleTemp;

                $titleTemp->recomendation_title_id = $request->title_id;

                if ($this->lecturer->canPrimary($request->supervisors['lecturer_id'])) {
                    $titleTemp->supervisor_1_id = $request->supervisors['lecturer_id'];
                } else {
                    $titleTemp->supervisor_2_id = $request->supervisors['lecturer_id'];
                }

                $titleTemp->save();
            });
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }
        return true;
    }

    public function acceptTitleRequest($recomendationTitleId)
    {
        try {
            DB::transaction(function () use ($recomendationTitleId) {
                $titleTemp = $this->titleTemp
                    ->whereRecomendationTitleId($recomendationTitleId)->first();

                $recomendationTitle = $this->recomendationTitle
                    ->findOrFail($recomendationTitleId);

                $finalProject = $this->finalProject;

                $finalProject->title = $recomendationTitle->title;
                $finalProject->final_student_id = $recomendationTitle->final_student_id;
                $finalProject->description = $recomendationTitle->description;

                $finalProject->save();

                $finalLog = new FinalLog;

                $finalLog->final_project_id = $finalProject->id;
                $finalLog->final_status_id = FinalStatus::name('pra-proposal');

                $finalLog->save();

                $supervisor = $this->supervisor;
                $supervisor->final_project_id = $finalProject->id;

                if (!is_null($titleTemp->supervisor_1_id)) {
                    $supervisor->role = 1;
                    $supervisor->lecturer_id = $titleTemp->supervisor_1_id;
                } else {
                    $supervisor->role = 2;
                    $supervisor->lecturer_id = $titleTemp->supervisor_2_id;
                }

                $supervisor->save();

                $this->deleteData($recomendationTitleId);
                $this->recomendationTitleService->deleteData($recomendationTitleId);
            });
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }
        return true;
    }

    public function declineTitleRequest($recomendationTitleId)
    {
        try {
            $recomendationTitle = $this->recomendationTitle
                ->findOrFail($recomendationTitleId);

            $recomendationTitle->final_student_id = null;

            $recomendationTitle->save();

            $this->deleteData($recomendationTitleId);
        } catch (\Throwable $th) {
            return "Failed";
        }
        return "Success";
    }

    public function deleteData($recomendationTitleId)
    {
        try {
            $this->titleTemp
                ->whereRecomendationTitleId($recomendationTitleId)->delete();
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
