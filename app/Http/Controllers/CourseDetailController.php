<?php

namespace App\Http\Controllers;

use App\Enums\CourseDetailStatus;
use App\Enums\CourseDetailType;
use App\Models\Course;
use App\Models\CourseDetail;
use App\Models\Faculty;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Yajra\Datatables\Datatables;

class CourseDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ControllerName = 'Lịch học';
    public function __construct()
    {
        $pageTitle =  Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }
    public function index()
    {
        $courses = Course::all();
        return view("courseDetail.index", compact('courses'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Course $course)
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
        $arrLessonInWeek = [];
        $arrLessonInCourse = [];
        $totalLessonInWeek = 0;
        $lesson = 0;
        $totalLessonInCourse = Course::find($request->course_id)->load('subject')->subject->credit * 15;
        for ($i = 0; $i < count($request->date); $i++) {
            // đếm tổng số tiết học trong 1 tuần
            $totalLessonInWeek += (int)$request->lesson_total[$i];
            // thời gian từng buổi học
            $arrLessonInWeek[$i]['course_id'] = (int)$request->course_id;
            $arrLessonInWeek[$i]['type'] = CourseDetailType::LICH_HOC;
            $arrLessonInWeek[$i]['status'] = CourseDetailStatus::MAC_DINH;
            $arrLessonInWeek[$i]['date'] = $request->date[$i];
            $arrLessonInWeek[$i]['lesson_start'] = (int)$request->lesson_start[$i];
            $arrLessonInWeek[$i]['lesson_total'] = (int)$request->lesson_total[$i];
        }
        $arrLessonInCourse = $arrLessonInWeek;
        // lấy ra tổng số tiết học trong 1 học phần (số tín chỉ * 15 tiết)
        $totalWeek = (int)floor(($totalLessonInCourse / $totalLessonInWeek));

        // Lặp những tuần tiếp theo 
        if (count($request->date) > 1) {
            for ($i = 0; $i <= $totalWeek; $i++) {
                foreach ($arrLessonInWeek as $key => $lessonInWeek) {
                    $date = new DateTime($lessonInWeek['date']);
                    $date->modify('+7 day');
                    $arrLessonInWeek[$key]['date'] = $date->format('Y-m-d');
                    $lesson += $lessonInWeek['lesson_total'];
                }
                $arrLessonInCourse[$i] = $arrLessonInWeek;
                if ($i == $totalWeek) {
                    for ($j = (count($arrLessonInCourse[$i]) - 1); $j >= 0; $j--) {
                        if ($arrLessonInCourse[$i][$j]['lesson_total'] <= ($lesson - $totalLessonInCourse)) {
                            $lesson = $lesson - $arrLessonInCourse[$i][$j]['lesson_total'];
                            unset($arrLessonInCourse[$i][$j]);
                        }
                    }
                    if ($lesson >  $totalLessonInCourse) {
                        $arrLessonInCourse[$i][count($arrLessonInCourse[$i]) - 1]['lesson_total'] -= $lesson - $totalLessonInCourse;
                    }
                }
            }
        }
        $arrLessonInCourse = array_filter($arrLessonInCourse);
        foreach ($arrLessonInCourse as $perWeek) {
            CourseDetail::insert($perWeek);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function show(CourseDetail $courseDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(CourseDetail $courseDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CourseDetail $courseDetail)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseDetail  $courseDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourseDetail $courseDetail)
    {
        //
    }
}
