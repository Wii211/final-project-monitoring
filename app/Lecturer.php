<?php

namespace App;

use App\Topic;
use App\Examiner;
use App\Position;
use App\Supervisor;
use App\RecomendationTitle;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
    protected $guarded = ['id'];

    public function recomendationTitles()
    {
        return $this->HasMany(RecomendationTitle::class);
    }

    public function examiners()
    {
        return $this->hasMany(Examiner::class);
    }

    public function supervisors()
    {
        return $this->hasMany(Supervisor::class);
    }

    public function primarySupervisors()
    {
        return $this->hasMany(Supervisor::class)
            ->whereRole(1)->whereIsAgree(1);
    }

    public function secondarySupervisors()
    {
        return $this->hasMany(Supervisor::class)
            ->whereRole(2)->whereIsAgree(1);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function topics()
    {
        return $this->belongsToMany(
            Topic::class,
            'lecturer_topic',
            'lecturer_id',
            'topic_id'
        );
    }

    /**
     * Check if lecturer can become 
     * primary supervisor by his postion
     *
     * @param  $lecturerId
     * @return \Illuminate\Http\Response
     */
    public function canPrimary($lecturerId): bool
    {
        $position = $this->with('position')->findOrFail($lecturerId);

        return $position->position->is_primary === 1 ? true : false;
    }

    public function scopePrimary($query, $q)
    {
        if ($q === null) return $query;

        if ($q == 'true') {
            $q = 1;
        } else {
            $q = 0;
        }
        return $query->whereHas('position', function ($query) use ($q) {
            $query->whereIsPrimary($q);
        });
    }
}
