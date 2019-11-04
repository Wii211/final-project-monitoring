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
    public function getListData($relation = null): LecturerCollection
    {
        //TODO Find More Elegant Solution
        $query = $relation == null ? $this->lecturer
            : $this->lecturer->with($relation);

        return new LecturerCollection($query->get());
    }

    public function getData($relation = null, $id): LecturerItem
    {
        return new LecturerItem($this->lecturer
            ->with($relation)->findOrFail($id));
    }

    public function storeData(Request $request)
    {
        //TODO TRY CATCH IF FAIL
        $fileName = " ";
        if ($request->hasFile('image_profile')) {
            $fileName = $this->uploadHelper->uploadImage(
                $request->file('image_profile'),
                $request->name,
                'lecturers'
            );
        }
        // try {
        $this->lecturer->create(
            array_merge(
                $request->except([
                    'image_profile',
                    'topics'
                ]),
                ['image_profile' => $fileName]
            )
        )->topics()->attach($request->topics);

        return response()->json("Success");
        // } catch (\Throwable $th) {
        //     return response()->json("Failed" . $th);
        // }
    }
}
