<?php


namespace App\Http\Services;

use App\FinalStudent;
use App\Helpers\UploadHelper;
use App\Http\Resources\FinalStudentCollection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FinalStudentService
{
    private $finalStudent;

    public function __construct(FinalStudent $finalStudent)
    {
        $this->$finalStudent = $finalStudent;
    }

    public function getListData($relation = null)
    {
        $query = $relation == null ? $this->finalStudent
            : $this->finalStudent->with($relation);

        return new FinalStudentCollection($query->get(['id', 'name', 'status', 'is_verified']));
    }
}
