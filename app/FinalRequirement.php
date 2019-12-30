<?php

namespace App;

use App\FinalLog;
use Illuminate\Database\Eloquent\Model;

class FinalRequirement extends Model
{
    protected $guarded = ['id'];

    public function finalLog()
    {
        return $this->belongsTo(FinalLog::class);
    }

    public function alreadySubmitted($finalLogId)
    {
        try {
            $finalRequirement  = $this->finalRequirement->findOrFail($finalLogId);
            return $finalRequirement ? true : false;
        } catch (\Throwable $th) {
            return false;
        }
    }
}
