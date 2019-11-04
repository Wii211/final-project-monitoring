<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LecturerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'personnel_id' => [
                Rule::unique('lecturers')->ignore($this->lecturer),
                'required'
            ],
            'lecturer_id' => [
                Rule::unique('lecturers')->ignore($this->lecturer),
                'required'
            ],
            'name' => ['required', 'string'],
            'last_education' => ['required', 'string'],
            'status' => ['required'],
            'email' => ['email'],
            'image_profile' => ['image', 'max:2048']

        ];
    }
}
