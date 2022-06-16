<?php

namespace App\Http\Requests\Subject;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:3',
                'max:255',
                'unique:App\Models\Subject,name'
            ],
            'credit' => [
                'required',
                'integer',
                'min:1',
                'max:5',
            ],
            'faculty_id' => [
                'required',
                'integer',
                'exists:faculties,id',
            ],
        ];
    }
}
