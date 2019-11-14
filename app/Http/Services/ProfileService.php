<?php

namespace App\Http\Services;

use App\Helpers\UploadHelper;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileService
{
    private $user, $uploadHelper;

    public function __construct(User $user, UploadHelper $uploadHelper)
    {
        $this->user = $user;
        $this->uploadHelper = $uploadHelper;
    }

    public function getData()
    {
        return $this->user->findOrFail(
            $this->user->getAuthId(),
            ['user_name', 'phone_number', 'image_profile']
        );
    }

    public function changeProfile(Request $request, $id)
    {
        $user = $this->user->findOrFail($id);



        if ($request->hasFile('image_profile')) {
            $imageProfile = $this->uploadHelper->uploadFile(
                $request->file('image_profile'),
                $user->user_name,
                'image_profile'
            );

            $user->phone_number = $request->phone_number;
            $user->image_profile = $imageProfile;
            try {
                if ($user->save()) {
                    return true;
                } else {
                    return false;
                }
            } catch (\Throwable $th) {
                dd($th);
            }
        }
    }

    public function changePassword(Request $request)
    {

        $user = $this->user->findOrFail($this->user->getAuthId());

        if (!Hash::check($request->old_password, $user->password)) {
            return response()->json([
                'message' => 'Password Lama Salah'
            ]);
        }
        $user->password = $request->password;

        if ($user->save()) {
            return true;
        } else {
            return false;
        }
    }
}