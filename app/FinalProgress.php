<?php

namespace App;

use App\FinalLog;
use App\Supervisor;
use Illuminate\Database\Eloquent\Model;

class FinalProgress extends Model
{
    public function finalLog()
    {
        return $this->belongsTo(FinalLog::class);
    }
}
