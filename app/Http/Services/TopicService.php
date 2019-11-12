<?php

namespace App\Http\Services;

use App\Topic;
use Illuminate\Http\Request;

class TopicService
{
    private $topic;

    public function __construct(Topic $topic)
    {
        $this->topic = $topic;
    }

    public function getListData()
    {
        return $this->topic->get();
    }
}
