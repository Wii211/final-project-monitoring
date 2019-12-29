<?php

namespace App;

use App\Lecturer;
use App\FinalProject;
use Illuminate\Database\Eloquent\Model;

class Examiner extends Model
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

    public static function filterExaminer($statusId, $examiners)
    {
        $filteredData = [];

        foreach ($examiners as $examiner) {
            if ($examiner->final_status_id  === $statusId) {
                $filteredData[] = $examiner;
            }
        }

        return $filteredData;
    }
}
