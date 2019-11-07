<?php

namespace App\Http\Services;

use App\FinalStudent;
use App\Helpers\UploadHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalRegistrationService
{
    private $finalStudent, $uploadHelper;

    public function __construct(FinalStudent $finalStudent, UploadHelper $uploadHelper)
    {
        $this->finalStudent = $finalStudent;
        $this->uploadHelper = $uploadHelper;
    }

    public function registerFinal(Request $request)
    {
        $finalStudentId = Auth::user()->finalStudent->id;

        if ($request->hasFile('transcript') && $request->hasFile('latest_study_plan')) {
            $transcriptName = $this->uploadHelper->uploadFile(
                $request->file('transcript'),
                $request->name,
                'transcript'
            );
            $latestStudyPlanName = $this->uploadHelper->uploadFile(
                $request->file('latest_study_plan'),
                $request->name,
                'latest_study_plan'
            );


            $finalStudent =  $this->finalStudent->findOrFail($finalStudentId);

            $finalStudent->transcript = $transcriptName;
            $finalStudent->latest_study_plan = $latestStudyPlanName;

            if ($finalStudent->save()) {
                return true;
            } else {
                return false;
            }
        }
    }

    public function verifyFinalStudent($finalStudentId)
    {
        $finalStudent =  $this->finalStudent->findOrFail($finalStudentId);

        $finalStudent->is_verified = 1;

        if ($finalStudent->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function unverifyFinalStudent($finalStudentId)
    {
        $finalStudent =  $this->finalStudent->findOrFail($finalStudentId);

        $finalStudent->is_verified = 0;

        if ($finalStudent->save()) {
            return true;
        } else {
            return false;
        }
    }
}
