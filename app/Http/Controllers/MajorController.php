<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use App\Models\Major;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;

class MajorController extends Controller
{
    public $ControllerName = 'Ngành học';
    public function __construct()
    {
        $pageTitle =  Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $faculties = Faculty::all();
        return view("major.index", compact('faculties'));
    }

    public function api()
    {
        return Datatables::of(Major::query()->with('faculty:id,name'))
            ->addColumn('action', function ($id) {
                return "<button type='button' class='btn action-icon' data-toggle='modal' data-target='#update-major' data-id='$id->id'>
                <i class='mdi mdi-pencil'></i>
                </button>
                <button type='button' class='btn action-icon' data-toggle='modal' data-target='#confirm-delete' data-id='$id->id'>
                <i class='mdi mdi-delete'></i>
                </button>";
            })
            ->addColumn('faculty', function ($major) {
                return $major->faculty->name;
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

    public function store(Request $request)
    {
        $major = new Major();
        $major->fill($request->all());
        $major->save();
        return redirect()->back()->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $major = Major::find($id);
        if ($major == null) {
            return response()->json([
                'status' => 'Not Found',
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'major' => $major,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $major = Major::findOrFail($request->id);
        $major->fill($request->all());
        $major->save();
        return redirect()->back()->with('success', 'Sửa thành công');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $major = Major::findOrFail($request->id);
        $major->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
