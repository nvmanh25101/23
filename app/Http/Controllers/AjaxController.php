<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\Training;

class AjaxController extends Controller
{
    //
    public function loadSubject($faculty_id)
    {
        $subjects = Subject::query()->where('faculty_id', $faculty_id)->get();
        return $subjects;
    }

    public function loadTeacher($faculty_id)
    {
        $teachers = Teacher::query()->where('faculty_id', $faculty_id)->get();
        return $teachers;
    }

    public function countClassRoom($major_id)
    {
        $classroom = Classroom::query()->where('major_id', $major_id)->count();
        return $classroom;
    }

    public function getSemester($training_id)
    {
        $semester = Training::find($training_id);
        return response()->json([
            'status' => 200,
            'semester' => $semester,
        ]);
    }
}
