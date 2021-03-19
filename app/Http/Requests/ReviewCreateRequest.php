<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewCreateRequest extends FormRequest
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
     * Get the validation rules that apply to the request.Так
     *
     * @return array
     */
    public function rules()
    {
        return [

        ];
    }

    public function messages()
    {
        return [

        ];
    }
}
