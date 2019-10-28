<?php

namespace App;

use App\Topic;
use App\Examiner;
use App\FinalLog;
use App\Supervisor;
use App\FinalStudent;
use Illuminate\Database\Eloquent\Model;

class FinalProject extends Model
{
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

    public function topics()
    {
        return $this->belongsToMany(
            Topic::class,
            'final_project_topic',
            'final_project_id',
            'topic_id'
        );
    }
}
