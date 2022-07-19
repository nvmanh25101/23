<?php

namespace App\Http\Requests\Teacher;

use App\Enums\TeacherLevelEnum;
use App\Enums\TeacherStatusEnum;
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
            ],
            'gender' => [
                'required',
                'boolean',
            ],
            'birthdate' => [
                'required',
                'date',
                'before:today',
            ],
            'address' => [
                'required',
                'string',
                'min:3',
                'max:255',
            ],
            'phone' => [
                'required',
                'string',
                'min:10',
                'max:15',
            ],
            'level' => [
                'required',
                'integer',
                Rule::in(TeacherLevelEnum::asArray()),
            ],
            'status' => [
                'required',
                'integer',
                Rule::in(TeacherStatusEnum::asArray()),
            ],
            'faculty_id' => [
                'required',
                'integer',
                'exists:faculties,id',
            ],
        ];
    }
}
