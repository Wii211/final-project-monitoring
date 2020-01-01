<?php

namespace App;

use App\RecomendationTitle;
use Illuminate\Database\Eloquent\Model;

class RecomendationTitleTemp extends Model
{
    public function recomendationTitle()
    {
        return $this->belongsTo(RecomendationTitle::class);
    }
}
