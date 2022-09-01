<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Major;
use App\Models\Plan;
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
    public function loadFaculty(Request $request)
    {
        return Faculty::query()->where('name', 'like', '%'.$request->get('q').'%')
            ->get([
                'id',
                'name',
            ]);
    }
    public function loadSubjectFromClassRoom($classroom_id)
    {
        $major = Classroom::find($classroom_id);
        $major->load('major.faculty');
        $faculty_id = $major->major->faculty_id;
        $subjects = Subject::query()->where('faculty_id', $faculty_id)->get()->toArray();
        return $subjects;
    }
    public function loadPlanFromClassRoom($classroom_id)
    {
        $plans = Plan::query()->where('classroom_id', $classroom_id)->with('subject')->get();
        return $plans;
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
