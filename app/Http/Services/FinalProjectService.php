<?php

namespace App\Http\Services;

use Carbon\Carbon;
use App\DeadlineSchedule;
use App\FinalLog;
use App\FinalProject;
use Illuminate\Http\Request;

class FinalProjectService
{
    private $finalProject, $finalLog;

    public function __construct(FinalProject $finalProject, FinalLog $finalLog)
    {
        $this->finalProject = $finalProject;
        $this->finalLog = $finalLog;
    }

    public function getData()
    { }
}
