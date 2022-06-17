<?php

namespace App\Http\Requests\Subject;

use App\Models\Subject;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
                Rule::unique(Subject::class)->ignore($this->subject),
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
