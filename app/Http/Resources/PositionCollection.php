<?php

namespace App\Http\Resources;

use App\Http\Resources\PositionItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PositionCollection extends ResourceCollection
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
            'data' => PositionItem::collection($this->collection)
        ];
    }
}
