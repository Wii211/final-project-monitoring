<?php

namespace App;

use App\User;
use App\Admin;
use App\Topic;
use App\Lecturer;
use App\FinalStudent;
use App\RecomendationTitleTemp;
use Illuminate\Database\Eloquent\Model;

class RecomendationTitle extends Model
{
    protected $guarded = ['id'];

    public function topics()
    {
        return $this->belongsToMany(
            Topic::class,
            'recomendation_topic',
            'recomendation_title_id',
            'topic_id'
        );
    }

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function finalStudent()
    {
        return $this->belongsTo(FinalStudent::class);
    }

    public function checkIfSubmited($finalStudentId)
    {
        if ($this->whereFinalStudentId($finalStudentId)->first()) {
            return true;
        } else {

            return false;
        }
    }

    public function recomendationTitleTemp()
    {
        return $this->hasOne(RecomendationTitleTemp::class);
    }

    /** 
     * insert userId who make insert or 
     * updating data to this table
     * 
     * @param $userId
     * @return  void
     */
    public function setUser($userId)
    {
        //TODO use this function for set userId
    }

    public function scopeSearch($query, $q)
    {
        if ($q === null) return $query;
        return $query
            ->where("title", "LIKE", "%{$q}%")
            ->orWhereHas('lecturer', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            })
            ->orWhereHas('topics', function ($query) use ($q) {
                $query->where('name', 'LIKE', "%{$q}%");
            });
    }

    public function isPicked()
    {
        $finalStudentId = new FinalStudent;

        $recomendationTitle =  $this->whereFinalStudentId($finalStudentId->getStudentId())
            ->whereHas('recomendationTitleTemp')->first();

        if ($recomendationTitle) {
            return true;
        } else {
            return false;
        }
    }
}
