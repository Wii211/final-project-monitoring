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

        return parent::toArray($request);
    }
}
