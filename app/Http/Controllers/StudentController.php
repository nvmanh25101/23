<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ControllerName = 'Sinh viên';
    public function __construct()
    {
        $pageTitle =  Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }
    public function index()
    {
        return view('student.index');
    }

    public function api()
    {
        return DataTables::of(Student::query())
            ->addColumn('action', function ($id) {
                return "<button type='button' class='btn action-icon' data-toggle='modal' data-target='#update-academicYear' data-id='$id->id'>
            <i class='mdi mdi-pencil'></i>
            </button>
            <button type='button' class='btn action-icon' data-toggle='modal' data-target='#confirm-delete' data-id='$id->id'>
            <i class='mdi mdi-delete'></i>
            </button>";
            })
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    public function schedule($classroom_id)
    {
        return view('student.schedule', compact('classroom_id'));
    }
    public function renderSchedule(Request $request, $classroom_id)
    {
        $schedules = Assignment::where('classroom_id', $classroom_id)->with('classroom:name,id', 'subject:name,id')
            ->where('date', ">", $request->startDateOfWeek)
            ->where('date', "<", $request->endDateOfWeek)
            ->get();
        return $schedules;
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        //
    }
}
