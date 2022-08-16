<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;

class AcademicYearController extends Controller
{
    public $ControllerName = 'Niên khóa';
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
        $academicYear = AcademicYear::query()->max('id');
        return view("academicYear.index", compact('academicYear'));
    }

    public function api()
    {
        return Datatables::of(AcademicYear::query())
            ->editColumn('id', function ($academicYear) {
                return "K" . $academicYear->id;
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
        AcademicYear::create([
            'name' => "",
        ]);
        return back()->with('success', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $academicYear = AcademicYear::find($id);
        if ($academicYear == null) {
            return response()->json([
                'status' => 'Not Found',
            ], 404);
        }
        return response()->json([
            'status' => true,
            'academicYear' => $academicYear,
        ], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $academicYear = AcademicYear::findOrFail($request->id);
        $academicYear->fill($request->all());
        $academicYear->save();
        return back()->with('success', 'Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AcademicYear  $academicYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $academicYear = AcademicYear::findOrFail($request->id);
        $academicYear->delete();
        return back()->with('success', 'Xóa thành công');
    }
}
