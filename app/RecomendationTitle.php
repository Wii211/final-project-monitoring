<?php

namespace App;

use App\Admin;
use App\Topic;
use App\Lecturer;
use App\FinalStudent;
use Illuminate\Database\Eloquent\Model;

class RecomendationTitle extends Model
{
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

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function finalStudent()
    {
        return $this->belongsTo(FinalStudent::class);
    }

    /** 
     * insert adminId who make insert or 
     * updating data to this table
     * 
     * @param $adminId
     * @return  void
     */
    public function setAdmin($adminId)
    {
        //TODO use this function for set adminId
    }
}
