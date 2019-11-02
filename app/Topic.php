<?php

namespace App;

use App\Lecturer;
use App\FinalProject;
use App\RecomendationTitle;
use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    public function recomendationTitles()
    {
        return $this->belongsToMany(
            RecomendationTitle::class,
            'recomendation_topic',
            'topic_id',
            'recomendation_title_id'

        );
    }

    public function finalProjects()
    {
        return $this->belongsToMany(
            FinalProject::class,
            'final_project_topic',
            'topic_id',
            'final_project_id'
        );
    }

    public function lecturers()
    {
        return $this->belongsToMany(
            Lecturer::class,
            'lecturer_topic',
            'topic_id',
            'lecturer_id'
        );
    }
}
