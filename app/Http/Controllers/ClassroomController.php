<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Classroom;
use App\Models\Major;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ControllerName = 'Lớp học';
    public function __construct()
    {
        $pageTitle =  Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }
    public function index()
    {
        $academicYear = AcademicYear::orderBy('id', 'desc')->first();
        $trainings = Training::all();
        $majors = Major::all();
        return view('classroom.index', compact('majors', 'academicYear', 'trainings'));
    }


    public function api()
    {
        return Datatables::of(Classroom::query()->with('major:name,id'))
            ->addColumn('action', function ($id) {
                return "<button type='button' class='btn action-icon' data-toggle='modal' data-target='#update-classroom' data-id='$id->id'>
                <i class='mdi mdi-pencil'></i>
                </button>
                <button type='button' class='btn action-icon' data-toggle='modal' data-target='#confirm-delete' data-id='$id->id'>
                <i class='mdi mdi-delete'></i>
                </button>";
            })
            ->addColumn('major', function ($major) {
                return $major->major->name;
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
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $classroom = new Classroom();
        $classroom->fill($request->all());
        $classroom->save();
        return redirect()->back()->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $classroom = Classroom::find($id);
        if ($classroom == null) {
            return response()->json([
                'status' => 'Not Found',
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'classroom' => $classroom,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Classroom $classroom)
    {
        $classroom = Classroom::findOrFail($request->id);
        $classroom->fill($request->all());
        $classroom->save();
        return redirect()->back()->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Classroom  $classroom
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $classroom = Classroom::findOrFail($request->id);
        $classroom->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
