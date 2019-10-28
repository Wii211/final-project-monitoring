<?php

namespace App;

use App\FinalLog;
use App\NewsReportImage;
use Illuminate\Database\Eloquent\Model;

class NewsReport extends Model
{
    public function newsReportImages()
    {
        return $this->hasMany(NewsReportImage::class);
    }

    public function finalLog()
    {
        return $this->belongsTo(FinalLog::class);
    }
}
