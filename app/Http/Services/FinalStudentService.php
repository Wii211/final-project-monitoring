<?php


namespace App\Http\Services;

use App\Lecturer;

use App\FinalStudent;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\FinalStudentCollection;

class FinalStudentService
{
    private $finalStudent, $lecturer;

    public function __construct(Lecturer $lecturer, FinalStudent $finalStudent)
    {
        $this->lecturer = $lecturer;
        $this->finalStudent = $finalStudent;
    }

    public function getListData($relation = null)
    {
        $query = $relation == null ? $this->finalStudent->active(true)
            : $this->finalStudent->active(true)->with($relation);

        return new FinalStudentCollection($query
            ->get(['id', 'name', 'status', 'is_verified', 'student_id']));
    }

    public function getData($relation = null, $id)
    {
        $query = $relation == null ? $this->finalStudent->active(true)
            : $this->finalStudent->active(true)->with($relation);

        return $query->findOrFail($id);
    }
}
