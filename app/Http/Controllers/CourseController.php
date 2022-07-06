<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Faculty;
use App\Models\Subject;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ControllerName = 'Học phần';
    public function __construct()
    {
        $pageTitle =  Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }

    public function index()
    {
        $subjects = Subject::all();
        return view("course.index", compact('subjects'));
    }

    public function api()
    {
        return Datatables::of(Course::query()->with('teacher', 'subject'))
            ->addColumn('action', function ($id) {
                $routeEditCourse = route('course.edit', $id);
                return "<a href='$routeEditCourse' type='button' class='btn action-icon'>
                <i class='mdi mdi-pencil'></i>
                </a>
                <button type='button' class='btn action-icon' data-toggle='modal' data-target='#confirm-delete' data-id='$id->id'>
                <i class='mdi mdi-delete'></i>
                </button>";
            })
            ->editColumn('subject_id', function ($course) {
                return $course->subject->name;
            })
            ->editColumn('teacher_id', function ($course) {
                return $course->teacher->name;
            })
            ->addColumn('course_code', function ($course) {
                $str = $course->subject->name;
                $ret = '';
                foreach (explode(' ', $str) as $word)
                    $ret .= strtoupper($word[0]);
                return $course->id . "-" . $ret;
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $faculties = Faculty::all();
        return view('course.create', compact('faculties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $course = new Course();
        $course->fill($request->all());
        $course->save();
        return redirect()->back()->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        if ($course == null) {
            return response()->json([
                'status' => 'Not Found',
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'course' => $course,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function edit(Course $course)
    {
        $faculties = Faculty::all();
        $course->load('subject');
        $faculty_id = $course->subject->faculty_id;
        return view('course.edit', compact('faculties', 'course', 'faculty_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Course $course)
    {
        $course->fill($request->all());
        $course->save();
        return redirect()->back()->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $course = Course::findOrFail($request->id);
        $course->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
