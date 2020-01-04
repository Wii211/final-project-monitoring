<?php

namespace App\Http\Resources;

use App\Examiner;
use Illuminate\Http\Resources\Json\JsonResource;

class FinalScheduleItem extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'    => $this->id,
            'student_name' => $this->finalLog->finalProject->finalStudent->name,
            'final_log_id' => $this->final_log_id,
            'title' => $this->finalLog->finalProject->title,
            'place' => $this->place,
            'date' => $this->date,
            'hour' => $this->hour,
            'end_date_hour' => $this->end_date_hour,
            'final_status' => $this->finalLog->finalStatus->name,
            'final_project_id' => $this->finalLog->finalProject->id,
            'status' => $this->status,
            'examiners' => Examiner::filterExaminer($this->finalLog->final_status_id, $this->finalLog->finalProject->examiners)
        ];
    }
}
