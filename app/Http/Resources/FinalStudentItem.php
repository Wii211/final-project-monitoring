<?php

namespace App\Http\Resources;

use App\Http\Resources\UserItem;
use Illuminate\Http\Resources\Json\JsonResource;

class FinalStudentItem extends JsonResource
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
            'transcript' => $this->transcript,
            'student_id' => $this->student_id,
            'name' => $this->name,
            'status' => $this->status,
            'is_verified' => $this->is_verified,
            'latest_study_plan' => $this->latest_study_plan,
            'user_id' => $this->user_id,
            'user' => new UserItem($this->whenLoaded('user')),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
