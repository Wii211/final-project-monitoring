<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsReportImageRequest extends FormRequest
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
            'news_report_images' => 'required',
            'news_report_images.*' => 'image',
            'news_report_image.*' => 'image',
        ];
    }
}
