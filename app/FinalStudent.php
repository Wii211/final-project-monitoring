<?php

namespace App;

use App\User;
use App\FinalProject;
use App\RecomendationTitle;
use Illuminate\Database\Eloquent\Model;

class FinalStudent extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function recomendationTitles()
    {
        return $this->hasMany(RecomendationTitle::class);
    }

    public function finalProject()
    {
        return $this->hasOne(FinalProject::class);
    }

    public function scopeActive($query, $value)
    {
        return $query->whereStatus($value);
    }
}
