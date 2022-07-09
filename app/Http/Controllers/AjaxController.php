<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Teacher;

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
}
