<?php

namespace App;


use Illuminate\Database\Eloquent\Relations\Pivot;

class LecturerTopic extends Pivot
{
    protected $table = 'lecturer_topic';
    public $timestamps = false;
}
