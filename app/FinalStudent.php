<?php

namespace App;

use App\User;
use App\FinalProject;
use App\RecomendationTitle;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class FinalStudent extends Model
{
    protected $guarded = ['id'];

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

    public function getStudentId()
    {

        return Auth::user()->finalStudent->id;
    }
}
