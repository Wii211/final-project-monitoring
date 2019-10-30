<?php

namespace App;

use App\Examiner;
use App\Position;
use App\Supervisor;
use App\RecomendationTitle;
use Illuminate\Database\Eloquent\Model;

class Lecturer extends Model
{
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

    public function position()
    {
        return $this->belongsTo(Position::class);
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
        $position = Lecturer::with('position')->findOrFail($lecturerId);

        return $position->position->is_prime === 1 ? true : false;
    }
}
