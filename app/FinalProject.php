<?php

namespace App;

use App\Topic;
use App\Examiner;
use App\FinalLog;
use App\Supervisor;
use App\FinalStatus;
use App\FinalStudent;
use Illuminate\Database\Eloquent\Model;

class FinalProject extends Model
{
    protected $guarded = ['id'];

    public function finalStudent()
    {
        return $this->belongsTo(FinalStudent::class);
    }

    public function examiners()
    {
        return $this->hasMany(Examiner::class);
    }

    public function supervisors()
    {
        return $this->hasMany(Supervisor::class);
    }

    public function finalLogs()
    {
        return $this->hasMany(FinalLog::class);
    }

    public function finalLogsPraProposal()
    {
        return $this->hasMany(FinalLog::class)->whereFinalStatusId(FinalStatus::name('pra-proposal'));
    }

    public function finalLogsProposal()
    {
        return $this->hasMany(FinalLog::class)->whereFinalStatusId(FinalStatus::name('proposal'));
    }

    public function finalLogEndOfFinal()
    {
        return $this->hasMany(FinalLog::class)
            ->whereFinalStatusId(FinalStatus::name('tugas_akhir_selesai'));
    }

    public function topics()
    {
        return $this->belongsToMany(
            Topic::class,
            'final_project_topic',
            'final_project_id',
            'topic_id'
        );
    }

    public function checkIsVerify($finalProjectId, $finalStatusName)
    {
        return FinalLog::whereFinalProjectId($finalProjectId)
            ->whereFinalStatusId(FinalStatus::name($finalStatusName))
            ->whereIsVerification(1)->first() ? true : false;
    }

    public function checkDuplicate($finalStudentId)
    {

        if ($this->whereFinalStudentId($finalStudentId)->first()) {
            return true;
        } else {
            return false;
        }
    }

    public function getFinalProjectFromStudent()
    {
        return $this->whereFinalStudentId(FinalStudent::getStudentId());
    }
}
