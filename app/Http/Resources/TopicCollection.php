<?php

namespace App\Http\Resources;

use App\Http\Resources\TopicItem;
use Illuminate\Http\Resources\Json\ResourceCollection;

class TopicCollection extends ResourceCollection
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
            'data' => TopicItem::collection($this->collection)
        ];
    }
}
