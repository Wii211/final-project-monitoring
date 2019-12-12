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
        if ($value === null) return $query;

        return $query->whereStatus($value);
    }

    public function scopeVerify($query, $value)
    {
        if ($value === null) return $query;

        return $query->whereIsVerified($value);
    }

    public function getStudentId()
    {

        return Auth::user()->finalStudent->id;
    }

    public static function convertActive($active)
    {
        return strtolower($active) == "aktif" ? 1 : 0;
    }

    public function checkIsVerify($id)
    {
        $finalStudent = $this->whereIsVerified(1)->whereUserId($id)->first();

        if (is_null($finalStudent)) {
            return false;
        } else {
            return true;
        }
    }
}
