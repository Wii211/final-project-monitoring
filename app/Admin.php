<?php

namespace App;

use App\User;
use App\RecomendationTitle;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{

    public function recomendationTitles()
    {
        return $this->hasMany(RecomendationTitle::class);
    }
}
