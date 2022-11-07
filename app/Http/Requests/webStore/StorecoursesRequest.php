<?php

namespace App\Http\Requests\webStore;

use Illuminate\Foundation\Http\FormRequest;

class StorecoursesRequest extends FormRequest
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
            'coach'=>['required','string'],
            'title'=>['required','string'],
            'desc_en'=>['required','string'],
            'des_ar'=>['required','string'],
            'price' =>['required','integer'],
            'image'=>['required','image'],
        ];
    }
}
