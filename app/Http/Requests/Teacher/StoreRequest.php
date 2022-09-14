<?php

namespace App\Http\Requests\Teacher;

use App\Enums\TeacherLevelEnum;
use App\Enums\TeacherStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            ],
            'gender' => [
                'required',
                'boolean',
            ],
            'email' => [
                'required',
                'email',
                'unique:App\Models\Teacher,email'
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'max:255',
            ],
            'birthdate' => [
                'required',
                'date',
                'before:today',
            ],
            'address' => [
                'required',
                'string',
            ],
            'phone' => [
                'required',
                'string',
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
