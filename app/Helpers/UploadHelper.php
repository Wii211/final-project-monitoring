<?php

namespace App\Helpers;

use File;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class UploadHelper
{
    public function uploadImage(UploadedFile $uploadedFile, $idName = null, $folder = null)
    {
        $path = storage_path('app/public/images');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path);
        }
        if (!File::isDirectory($path . '/' . $folder)) {
            File::makeDirectory($path . '/' . $folder);
        }

        $fileName = !is_null($idName) ? $idName . '_' .
            Carbon::now()->timestamp . '_' . uniqId() : str_random(25);

        // $uploadedFile =  $uploadedFile->resize(320, 240);

        $file = $uploadedFile->storeAs($folder, $fileName .
            '.' . $uploadedFile->getClientOriginalExtension());

        if ($file) {

            return $file;
        } else {
            return false;
        }
    }
}
