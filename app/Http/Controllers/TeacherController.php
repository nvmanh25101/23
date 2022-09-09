<?php

namespace App\Http\Controllers;

use App\Enums\TeacherLevelEnum;
use App\Enums\TeacherStatusEnum;
use App\Http\Requests\Teacher\StoreRequest;
use App\Http\Requests\Teacher\UpdateRequest;
use App\Models\Faculty;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

class TeacherController extends Controller
{
    public $ControllerName = 'Giảng viên';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);

        $arrTeacherLevel = TeacherLevelEnum::getArrayView();
        view()->share('arrTeacherLevel', $arrTeacherLevel);
        $arrTeacherStatus = TeacherStatusEnum::getArrayView();
        view()->share('arrTeacherStatus', $arrTeacherStatus);
    }

    public function index()
    {
        return view('teachers.index');
    }

    public function api()
    {
        return DataTables::of(Teacher::query()->with('faculty'))
//            ->addColumn('infor', function ($object) {
//                return $object->genderName.' - '.$object->age.' Tuổi'.'<br>'.$object->phone;
//            })
            ->addColumn('faculty_name', function ($object) {
                return $object->faculty->name;
            })
            ->editColumn('level', function ($object) {
                return TeacherLevelEnum::getKeyByValue($object->level);
            })
            ->editColumn('status', function ($object) {
                return TeacherStatusEnum::getKeyByValue($object->status);
            })
            ->addColumn('edit', function ($object) {
                return route('teachers.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('teachers.destroy', $object);
            })
            ->rawColumns(['infor', 'infor'])
            ->make(true);
    }

    public function create()
    {
        $faculties = Faculty::query()->get(['id', 'name']);
        return view('teachers.create',
            [
                'faculties' => $faculties,
            ]);
    }

    public function store(StoreRequest $request)
    {
        $password = Hash::make($request->password);
        $arr = $request->validated();
        $arr['password'] = $password;
        Teacher::query()->create($arr);

        return redirect()->route('teachers.index');
    }

    public function show(Teacher $teacher)
    {
        //
    }

    public function edit($teacherId)
    {
        $teacher = Teacher::query()->findOrFail($teacherId);
        $faculties = Faculty::query()->get(['id', 'name']);

        return view('teachers.edit',
            [
                'teacher' => $teacher,
                'faculties' => $faculties,
            ]);
    }

    public function update(UpdateRequest $request,$teacherId)
    {
        $teacher = Teacher::query()->findOrFail($teacherId);
        $teacher->fill($request->validated());
        $teacher->save();

        return redirect()->route('teachers.index');
    }

    public function destroy($teacherId)
    {
        Teacher::destroy($teacherId);

        $arr = [];
        $arr['status'] = true;
        $arr['message'] = 'Xóa thành công';
        return response($arr, 200);
    }
}
