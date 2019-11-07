<?php

namespace App\Http\Resources;

use App\Http\Resources\FinalStudentItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FinalStudentCollection extends ResourceCollection
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
            'data' => FinalStudentItem::collection($this->collection)
        ];
    }
}
