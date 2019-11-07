<?php

namespace App\Http\Resources;

use App\FinalStudent;
use Illuminate\Http\Resources\Json\JsonResource;

class UserItem extends JsonResource
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
            'user_name' => $this->user_name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'image_profile' => $this->image_profile,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'latest_study_plan' => $this->latest_study_plan,
            'final_student' => new FinalStudent($this->whenLoaded('finalStudent')),
        ];
    }
}
