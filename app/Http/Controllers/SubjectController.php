<?php

namespace App\Http\Controllers;

use App\Http\Requests\Subject\StoreRequest;
use App\Http\Requests\Subject\UpdateRequest;
use App\Models\Faculty;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\DataTables\DataTables;

class SubjectController extends Controller
{
    public string $ControllerName = 'Môn học';

    public function __construct()
    {
        $pageTitle = Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }

    public function index()
    {
        return view('subjects.index');
    }

    public function api()
    {
        return DataTables::of(Subject::query()->with('faculty'))
            ->addColumn('faculty_name', function ($object) {
                return $object->faculty->name;
            })
            ->addColumn('edit', function ($object) {
                return route('subjects.edit', $object);
            })
            ->addColumn('destroy', function ($object) {
                return route('subjects.destroy', $object);
            })
            ->make(true);
    }

    public function create()
    {
        $faculties = Faculty::query()->get();
        return view('subjects.create', [
            'faculties' => $faculties,
        ]);
    }

    public function store(StoreRequest $request)
    {
        Subject::query()->create($request->validated());

        return redirect()->route('subjects.index');
    }

    public function show(Subject $subject)
    {
        //
    }

    public function edit($subject)
    {
        $subject = Subject::query()->findOrFail($subject);
        $faculties = Faculty::query()->get();
        return view('subjects.edit', [
            'subject' => $subject,
            'faculties' => $faculties,
        ]);
    }

    public function update(UpdateRequest $request, $subject)
    {
        $subject = Subject::query()->findOrFail($subject);
        $subject->fill($request->validated());
        $subject->save();

        return redirect()->route('subjects.index');
    }

    public function destroy($subject)
    {
        Subject::query()->where('id', $subject)->delete();

        $arr = [];
        $arr['status'] = true;
        $arr['message'] = 'Xóa thành công';
        return response($arr, 200);
    }
}
