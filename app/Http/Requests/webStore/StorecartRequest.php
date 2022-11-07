<?php
namespace App\Http\Requests\webStore;


use Illuminate\Foundation\Http\FormRequest;

class StorecartRequest extends FormRequest
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
            'number' => ['required','integer','digits:16'],
            'exp_month' =>['required','integer','digits:2'],
            'exp_year' => ['required','integer','digits:4'],
            'cvc' => ['required','integer'],
        ];
    }
}
