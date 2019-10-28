<?php

namespace App;

use App\Supervisor;
use Illuminate\Database\Eloquent\Model;

class FinalProgress extends Model
{
    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class);
    }
}
