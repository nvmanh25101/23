<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use Yajra\Datatables\Datatables;

class FacultyController extends Controller
{
    public $ControllerName = 'Khoa';
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
        return view("faculty.index");
    }

    public function api()
    {
        return Datatables::of(Faculty::query())
            ->addColumn('action', function ($id) {
                return "<button type='button' class='btn action-icon' data-toggle='modal' data-target='#update-faculty' data-id='$id->id'>
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
    }

    public function store(Request $request)
    {
        $faculty = new Faculty();
        $faculty->fill($request->all());
        $faculty->save();
        return redirect()->back()->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $faculty = Faculty::find($id);
        if ($faculty == null) {
            return response()->json([
                'status' => 'Not Found',
            ], 404);
        }
        return response()->json([
            'status' => 200,
            'faculty' => $faculty,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $faculty = Faculty::findOrFail($request->id);
        $faculty->name = $request->name;
        $faculty->save();
        return redirect()->back()->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Faculty  $faculty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $faculty = Faculty::findOrFail($request->id);
        $faculty->delete();
        return redirect()->back()->with('success', 'Xóa thành công');
    }
}
