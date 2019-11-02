<?php

namespace App\Http\Resources;

use App\Http\Resources\LecturerItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class LecturerCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => LecturerItem::collection($this->collection)
        ];
    }
}
