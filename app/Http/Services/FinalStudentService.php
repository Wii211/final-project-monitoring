<?php


namespace App\Http\Services;

use App\Role;

use App\User;
use App\Lecturer;
use App\FinalStudent;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class FinalStudentService
{
    private $finalStudent, $lecturer, $user, $role;

    public function __construct(
        Lecturer $lecturer,
        FinalStudent $finalStudent,
        User $user,
        Role $role
    ) {
        $this->lecturer = $lecturer;
        $this->finalStudent = $finalStudent;
        $this->user = $user;
        $this->role = $role;
    }

    public function getListData($relation = null, $active)
    {
        $query = $relation == null ? $this->finalStudent
            : $this->finalStudent->with($relation);

        return $query->active($active)->get();
    }

    public function getData($relation = null, $id)
    {
        $query = $relation == null ? $this->finalStudent
            : $this->finalStudent->with($relation);

        return $query->findOrFail($id);
    }

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $user = $this->user([
                    'user_name' => $request->student_id,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'gender' => $request->gender,
                    'image_profile' => 'https://lorempixel.com/640/480/?40069',
                    'password' => $request->student_id . $request->name,
                ]);

                $user->save();

                $user->roles()->sync($this->role->name('mahasiswa')->id);

                $finalStudent = $this->finalStudent([
                    'student_id' => $request->student_id,
                    'status' => $request->status,
                    'is_verified' => 0,
                    'user_id' => $user->id,
                    'name' => $request->name
                ]);

                $finalStudent->save();
            });
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }

    public function update(Request $request, $id)
    {

        try {
            DB::transaction(function () use ($request, $id) {
                $user = $this->user->findOrFail($id);

                $user->user_name = $request->student_id;
                $user->email = $request->email;
                $user->phone_number = $request->phone_number;
                $user->gender = $request->gender;
                $user->password = $request->password;

                $user->save();

                $finalStudent = $this->finalStudent->whereUserId($id)->first();
                $finalStudent->name = $request->name;
                $finalStudent->student_id = $request->student_id;
                $finalStudent->status = $request->status;
                $finalStudent->is_verified = $request->is_verified;

                $finalStudent->save();
            });
        } catch (\Throwable $th) {
            return false;
        }
        return true;
    }
}
