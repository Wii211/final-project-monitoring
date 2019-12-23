<?php

namespace App\Imports;

use App\Role;
use App\User;
use App\FinalStudent;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class FinalStudentsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // $user = new User([
            //     'user_name' => $row['nim'],
            // 'email' => $row['email'],
            // 'phone_number' => $row['nomor_telepon'],
            // 'gender' => $row['jenis_kelamin'],
            // 'image_profile' => null,
            // 'password' => $row['nim'],
            // ]);

            $user  = User::updateOrCreate(
                ['user_name' => $row['nim']],
                [
                    'email' => $row['email'],
                    'phone_number' => $row['nomor_telepon'],
                    'gender' => $row['jenis_kelamin'],
                    'image_profile' => null,
                    'password' => $row['nim'],
                ]
            );



            // $user->save();
            $user->roles()->sync(Role::whereName('mahasiswa')->first()->id);

            // FinalStudent::create([
            //     'student_id' => $row['nim'],
            // 'status' => FinalStudent::convertActive($row['status']),
            // 'is_verified' => 0,
            // 'user_id' => $user->id,
            // 'name' => $row['nama']
            // ]);

            FinalStudent::updateOrCreate(
                ['student_id' => $row['nim']],
                [
                    'status' => FinalStudent::convertActive($row['status']),
                    'is_verified' => 0,
                    'user_id' => $user->id,
                    'name' => $row['nama']
                ]
            );
        }
    }
}
