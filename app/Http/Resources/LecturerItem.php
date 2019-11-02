<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LecturerItem extends JsonResource
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
            'personnel_id' => $this->personnel_id,
            'lecturer_id' => $this->lecturer_id,
            'name' => $this->name,
            'status' => $this->status
        ];
    }
}
