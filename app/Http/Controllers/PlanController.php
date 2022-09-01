<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Plan;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public $ControllerName = 'Chương trình đào tạo';
    public function __construct()
    {
        $pageTitle =  Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }
    public function index()
    {
        return view('plan.index');
    }

    public function api()
    {
        return Datatables::of(Plan::query()->select('classroom_id')->distinct('classroom_id')->with('classroom.major')->get())
            ->editColumn('classroom', function ($classroom) {
                return $classroom->classroom->name;
            })
            ->addColumn('major', function ($classroom) {
                return $classroom->classroom->major->name;
            })
            ->addColumn('action', function ($id) {
                return "<button type='button' class='btn action-icon' data-toggle='modal' data-target='#update-major' data-id='$id->id'>
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
        $classRooms = Classroom::all();
        // dd($subjects);
        return view('plan.create', compact('classRooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $plans = $request->subject_id;
        $arr_plan = [];
        $all_subject = [];
        foreach ($plans as $key => $plan) {
            $semester = explode("-", $plan)[0];
            $subject = (int)explode("-", $plan)[1];
            $all_subject[] = $subject;
            $arr_plan[$key]['semester'] = (int)$semester;
            $arr_plan[$key]['subject_id'] = (int)$subject;
            $arr_plan[$key]['classroom_id'] = (int)$request->classroom_id;
        }
        // if (count(array_unique($all_subject)) < count($all_subject)) {
        //     // return back();
        // } else {
        //     dd($arr_plan);
        // }
        // dd($arr_plan);
        foreach ($arr_plan as $item) {
            Plan::create([
                'semester' => $item['semester'],
                'subject_id' => $item['subject_id'],
                'classroom_id' => $item['classroom_id'],
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function show($classroom_id)
    {
        $plans = Plan::query()->select('semester', 'subject_id')->where('classroom_id', $classroom_id)->get()->toArray();
        $arr_plan = [];
        foreach ($plans as $plan) {
            $arr_plan[$plan['semester']][] = $plan['subject_id'];
        }
        $classroom = Classroom::find($classroom_id);

        $major = Classroom::find($classroom_id);
        $major->load('major.faculty');
        $faculty_id = $major->major->faculty_id;
        $subjects = Subject::query()->where('faculty_id', $faculty_id)->get();

        // dd($arr_plan);
        return view('plan.show', compact('arr_plan', 'classroom', 'subjects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Plan  $plan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
