<?php

namespace App\Http\Services;

use App\Helpers\UploadHelper;
use App\Lecturer;
use App\Http\Resources\LecturerCollection;
use App\Http\Resources\LecturerItem;

use Illuminate\Http\Request;

class LecturerService
{


    private $lecturer, $uploadHelper;

    public function __construct(Lecturer $lecturer, UploadHelper $uploadHelper)
    {
        $this->lecturer = $lecturer;
        $this->uploadHelper = $uploadHelper;
    }

    /**
     * Get listData with relationship as parameter.
     *
     * @param  $relation
     * @return App\Http\Resources\LecturerCollection 
     */
    public function getListData($relation = null, $q, $data)
    {
        //TODO Find More Elegant Solution
        $query = $relation == null ? $this->lecturer
            : $this->lecturer->with($relation);

        return $query->primary($q)->withCount('primarySupervisors')
            ->withCount('secondarySupervisors')->get($data);
    }

    public function getListDataPrimary($relation = null)
    {
        return $this->lecturer->primary->get();
    }

    public function getData($relation = null, $id): LecturerItem
    {
        return new LecturerItem($this->lecturer
            ->with($relation)->findOrFail($id));
    }

    public function storeData(Request $request)
    {
        try {
            $fileName = " ";
            if ($request->hasFile('image_profile')) {
                $fileName = $this->uploadHelper->uploadImage(
                    $request->file('image_profile'),
                    $request->personnel_id,
                    'lecturers'
                );
            }
            $this->lecturer->create(
                array_merge(
                    $request->except([
                        'image_profile',
                        'topics'
                    ]),
                    ['image_profile' => $fileName]
                )
            )->topics()->attach($request->topics);
            return true;
        } catch (\Throwable $th) {
            dd($th);
            return false;
        }
    }

    public function updateData(Request $request, $id)
    {
        try {

            $lecturer = $this->lecturer->findOrFail($id);

            $fileName = $lecturer->image_profile;

            if ($request->hasFile('image_profile')) {
                if ($lecturer->image_profile) {
                    $this->uploadHelper->deleteFile($lecturer->image_profile);
                }
                $fileName = $this->uploadHelper->uploadImage(
                    $request->file('image_profile'),
                    $request->personnel_id,
                    'lecturers'
                );
            }
            $lecturer->update(
                array_merge(
                    $request->except([
                        'image_profile',
                        'topics'
                    ]),
                    ['image_profile' => $fileName]
                )
            );
            $lecturer->topics()->sync($request->topics);

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function doNonActive($id)
    {
        try {
            $lecturer = $this->lecturer->findOrFail($id);

            $lecturer->status = 0;

            if ($lecturer->save()) {
                return true;
            }
        } catch (\Throwable $th) {
            return false;
        }
    }
}
