<?php

namespace App;

use App\NewsReport;
use Illuminate\Database\Eloquent\Model;

class NewsReportImage extends Model
{
    public function newsReport()
    {
        return $this->belongsTo(NewsReport::class);
    }
}
