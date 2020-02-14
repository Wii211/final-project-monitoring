<?php

namespace App\Http\Services;

use App\User;
use App\FinalLog;
use App\Lecturer;
use App\Supervisor;
use App\FinalStatus;
use App\FinalProject;
use App\FinalStudent;
use App\Helpers\UploadHelper;
use App\RecomendationTitle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class PreProposalService
{
    private $finalProject, $finalStudent, $finalLog, $recomendationTitle,
        $finalStatus, $lecturer, $supervisor, $uploadHelper;

    public function __construct(
        FinalProject $finalProject,
        FinalStudent $finalStudent,
        FinalLog $finalLog,
        RecomendationTitle $recomendationTitle,
        FinalStatus $finalStatus,
        Lecturer $lecturer,
        Supervisor $supervisor,
        UploadHelper $uploadHelper
    ) {
        $this->finalProject = $finalProject;
        $this->finalStudent = $finalStudent;
        $this->finalLog = $finalLog;
        $this->recomendationTitle = $recomendationTitle;
        $this->finalStatus = $finalStatus;
        $this->lecturer = $lecturer;
        $this->supervisor = $supervisor;
        $this->uploadHelper = $uploadHelper;
    }

    public function getData($id, $relation)
    {
        return $this->finalProject->with($relation)->whereFinalStudentId($id)->first();
    }

    public function submitWithRecomendationTitle(Request $request)
    {
        //not used for another function

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

                $verificationFile = "";

                if ($request->hasFile('supervisors_file')) {
                    $verificationFile = $this->uploadHelper->uploadImage(
                        $request->file('supervisors_file'),
                        $request->title . " " . $request->supervisors['lecturer_id']
                            . " " . $request->supervisors['role'],
                        'supervisors_verification'
                    );
                }

                $finalProject->supervisors()->create([
                    'role' => $request->supervisors['role'],
                    'lecturer_id' => $request->supervisors['lecturer_id'],
                    'final_project_id' => $finalProject->id,
                    'is_agree' => 0,
                    'verification_file' => $verificationFile
                ]);

                if (isset($request->is_supervisors)) {
                    $verificationFile2 = "";
                    if ($request->hasFile('supervisors2_file')) {
                        $verificationFile2 = $this->uploadHelper->uploadImage(
                            $request->file('supervisors2_file'),
                            $request->title . " " . $request->supervisors2['lecturer_id']
                                . " " . $request->supervisors2['role'],
                            'supervisors_verification'
                        );
                    }

                    $finalProject->supervisors()->create([
                        'role' => $request->supervisors2['role'],
                        'lecturer_id' => $request->supervisors2['lecturer_id'],
                        'final_project_id' => $finalProject->id,
                        'is_agree' => 0,
                        'verification_file' => $verificationFile2
                    ]);
                }
            });
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }
        return true;
    }

    public function update($finalProjectId, Request $request)
    {
        try {
            DB::transaction(function () use ($request, $finalProjectId) {

                $finalProject = $this->finalProject->findOrFail($finalProjectId);

                $finalProject->title = $request->title;
                $finalProject->description = $request->description;
                $finalProject->save();

                $this->supervisor->whereFinalProjectId($finalProjectId)->whereRole(1)
                    ->update(
                        [
                            'lecturer_id' => $request->supervisors['lecturer_id']
                        ]
                    );


                if ($this->supervisor->whereFinalProjectId($finalProjectId)->whereRole(2)->first()) {
                    $this->supervisor->whereFinalProjectId($finalProjectId)->whereRole(2)
                        ->update(
                            [
                                'lecturer_id' => $request->supervisors2['lecturer_id']
                            ]
                        );
                } else {
                    $newSupervisor = new Supervisor([
                        'role' => 2,
                        'final_project_id' => $finalProjectId,
                        'lecturer_id' => $request->supervisors2['lecturer_id'],
                        'is_agree' => 0
                    ]);

                    $newSupervisor->save();
                }


                $supervisor1 = $this->supervisor
                    ->whereFinalProjectId($finalProjectId)->whereRole(1)->first();

                if ($request->hasFile('supervisors_file')) {
                    $verificationFile = $this->uploadHelper->uploadImage(
                        $request->file('supervisors_file'),
                        $request->title . " " . $request->supervisors['lecturer_id']
                            . " " . $request->supervisors['role'],
                        'supervisors_verification'
                    );
                    if ($supervisor1->verification_file) {
                        $this->uploadHelper
                            ->deleteFile($supervisor1->verification_file);
                    }
                    $supervisor1->verification_file = $verificationFile;
                    $supervisor1->save();
                }

                if (isset($request->is_supervisors)) {
                    $supervisor2 = $this->supervisor
                        ->whereFinalProjectId($finalProjectId)->whereRole(2)->first();
                    $verificationFile2 = "";
                    if ($request->hasFile('supervisors2_file')) {
                        $verificationFile2 = $this->uploadHelper->uploadImage(
                            $request->file('supervisors2_file'),
                            $request->title . " " . $request->supervisors2['lecturer_id']
                                . " " . $request->supervisors2['role'],
                            'supervisors_verification'
                        );

                        if ($supervisor2->verification_file) {
                            $this->uploadHelper
                                ->deleteFile($supervisor2->verification_file);
                        }
                        $supervisor2->verification_file = $verificationFile2;
                        $supervisor2->save();
                    }
                }
            });
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }
        return true;
    }

    public function updateToProposal($finalProjectId)
    {
        try {
            $preProposal = $this->finalLog->whereFinalProjectId($finalProjectId)
                ->whereFinalStatusId($this->finalStatus->name('pra-proposal'))->first();

            $preProposal->is_verification = 1;

            $preProposal->save();

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

        if ($this->finalProject->checkDuplicate($finalStudentId)) return true;

        if ($this->recomendationTitle->checkIfSubmited($finalStudentId)) return true;

        return false;
    }
}
