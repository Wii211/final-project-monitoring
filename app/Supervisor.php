<?php

namespace App;

use App\Lecturer;
use App\FinalProject;
use App\FinalProgress;
use Illuminate\Database\Eloquent\Model;

class Supervisor extends Model
{
    protected $guarded = ['id'];

    public function lecturer()
    {
        return $this->belongsTo(Lecturer::class);
    }

    public function finalProject()
    {
        return $this->belongsTo(FinalProject::class);
    }

    public function finalProgresses()
    {
        return $this->hasMany(FinalProgress::class);
    }

    public function checkSupervisorsQuota($lecturerId, $role)
    {
        $lecturerCount = $this->whereHas('finalProject', function ($q) {
            $q->whereDoesntHave('finalLogEndOfFinal');
        })->whereRole($role)->whereIsAgree(1)
            ->whereLecturerId($lecturerId)->count();


        return $lecturerCount > 8 ? true : false;
    }
}
