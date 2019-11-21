<?php

namespace App\Imports;

use App\FinalStudent;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class FinalStudentsImport implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $user = new User([
                'user_name' => $row['nim'],
                'email' => $row['email'],
                'phone_number' => $row['nomor_telepon'],
                'gender' => $row['jenis_kelamin'],
                'image_profile' => 'https://lorempixel.com/640/480/?40069',
                'password' => $row['nim'] . $row['nama'],
            ]);

            $user->roles()->sync($this->role->name('mahasiswa')->id);

            FinalStudent::create([
                'student_id' => $row['nim'],
                'status' => 0,
                'is_verified' => 0,
                'user_id' => $user->id,
                'name' => $row['nama']
            ]);
        }
    }
}
