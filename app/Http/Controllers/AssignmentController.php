<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\Classroom;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $ControllerName = 'Phân công giảng dạy';
    public function __construct()
    {
        $pageTitle =  Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }

    public function index()
    {
        $teachers = Teacher::all();
        return view('assignment.create', compact('teachers'));
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function findClass(Request $request)
    {
        $classrooms = Classroom::query();
        $assignment = Assignment::query()
            ->where('date', $request->date)
            ->where('teacher_id', $request->teacher_id)
            ->whereRaw("((" . $request->lesson_start . ' between lesson_start and lesson_end)')
            ->orWhereRaw("(" . $request->lesson_end . ' between lesson_start and lesson_end))')
            ->count();
        // ->toSql();
        // dd($assignment);
        if ($assignment > 0) {
            $error = [
                'type' => 'error',
                'message' => 'Giáo viên này đang bận. Vui lòng chọn thời gian khác',
                'code' => 404,
            ];
            return response($error, $error['code']);
        } else {
            $classrooms = $classrooms->whereDoesntHave('assignments', function ($query) use ($request) {
                $query->where('date', $request->date);
                $query->whereRaw("((" . $request->lesson_start . ' between lesson_start and lesson_end)');
                $query->orWhereRaw("(" . $request->lesson_end . ' between lesson_start and lesson_end))');
            });
        }
        $classrooms = $classrooms->get();
        // $classrooms = $classrooms->toSql();
        return $classrooms;
    }

    public function store(Request $request)
    {
        $arrAssignmentInWeek = [];
        $arrAssignmentInSemester = [];
        $subject_assignment = [];
        $totalLessonInWeek = 0;
        $learnedLesson = 0;
        for ($i = 0; $i < count($request->date); $i++) {
            $arrAssignmentInWeek[$i]['teacher_id'] = $request->teacher_id;
            $arrAssignmentInWeek[$i]['date'] = $request->date[$i];
            $arrAssignmentInWeek[$i]['lesson_start'] = $request->lesson_start[$i];
            $arrAssignmentInWeek[$i]['lesson_end'] = $request->lesson_end[$i];
            $arrAssignmentInWeek[$i]['classroom_id'] = $request->classroom_id[$i];
            $arrAssignmentInWeek[$i]['subject_id'] = $request->subject_id[$i];
            $subject_assignment[$i] = $request->classroom_id[$i] . "-" . $request->subject_id[$i];
        }
        $countTeachingInWeeks = array_count_values($subject_assignment); // (classroom_id) -  (subject_id)
        foreach ($countTeachingInWeeks as $key => $value) {
            if ($value  < 2) {
                foreach ($arrAssignmentInWeek as $item => $assignment) {
                    $classroom_id = $assignment['classroom_id'];
                    $subject_id = $assignment['subject_id'];
                    if (explode('-', $key)[0] ==  $classroom_id && explode('-', $key)[1] == $subject_id) {
                        $totalLessonInSemester = Subject::find($subject_id)->credit * 15;
                        $totalLessonInWeek = $assignment['lesson_end'] - $assignment['lesson_start'] + 1;
                        $arrAssignmentInSemester[$key][0][] = $assignment;
                        $totalWeek = (int)floor($totalLessonInSemester / $totalLessonInWeek);
                        for ($i = 1; $i < $totalWeek; $i++) {
                            $date = 7 * $i;
                            $arrAssignmentInSemester[$key][$i][0]['teacher_id'] = $assignment['teacher_id'];
                            $arrAssignmentInSemester[$key][$i][0]['date'] = Carbon::createFromFormat('Y-m-d', $assignment['date'])->addDay($date)->format('Y-m-d');
                            $arrAssignmentInSemester[$key][$i][0]['lesson_start'] = $assignment['lesson_start'];
                            $arrAssignmentInSemester[$key][$i][0]['lesson_end'] = $assignment['lesson_end'];
                            $arrAssignmentInSemester[$key][$i][0]['classroom_id'] = $assignment['classroom_id'];
                            $arrAssignmentInSemester[$key][$i][0]['subject_id'] = $assignment['subject_id'];
                        }
                    }
                }
            } else {
                foreach ($arrAssignmentInWeek as $assignment) {
                    $classroom_id = (int)$assignment['classroom_id'];
                    $subject_id = (int)$assignment['subject_id'];
                    if (explode('-', $key)[0] ==  $classroom_id && explode('-', $key)[1] == $subject_id) {
                        $totalLessonInSemester = Subject::find($subject_id)->credit * 15;
                        $totalLessonInWeek += ($assignment['lesson_end'] - $assignment['lesson_start'] + 1);
                        $learnedLesson += ($assignment['lesson_end'] - $assignment['lesson_start'] + 1);
                        $totalWeek = (int)floor($totalLessonInSemester / $totalLessonInWeek);
                    }
                }
                foreach ($arrAssignmentInWeek as $assignment) {
                    $classroom_id = $assignment['classroom_id'];
                    $subject_id = $assignment['subject_id'];
                    if (explode('-', $key)[0] ==  $classroom_id && explode('-', $key)[1] == $subject_id) {
                        $arrAssignmentInSemester[$key][0][] = $assignment;
                    }
                }
                for ($i = 1; $i <= $totalWeek; $i++) {
                    foreach ($arrAssignmentInSemester[$key][0] as $item => $value) {
                        $date = 7 * $i;
                        $arrAssignmentInSemester[$key][$i][$item]['teacher_id'] = $value['teacher_id'];
                        $arrAssignmentInSemester[$key][$i][$item]['date'] = Carbon::createFromFormat('Y-m-d', $value['date'])->addDay($date)->format('Y-m-d');
                        $arrAssignmentInSemester[$key][$i][$item]['lesson_start'] = $value['lesson_start'];
                        $arrAssignmentInSemester[$key][$i][$item]['lesson_end'] = $value['lesson_end'];
                        $arrAssignmentInSemester[$key][$i][$item]['classroom_id'] = $value['classroom_id'];
                        $arrAssignmentInSemester[$key][$i][$item]['subject_id'] = $value['subject_id'];
                        $learnedLesson += $value['lesson_end'] - $value['lesson_start'] + 1;
                        $redundantLesson = $learnedLesson - $totalLessonInSemester;
                        if ($redundantLesson > 0) {
                            if ($redundantLesson >= $arrAssignmentInSemester[$key][$totalWeek][$item]['lesson_end'] - $arrAssignmentInSemester[$key][$totalWeek][$item]['lesson_start'] + 1) {
                                unset($arrAssignmentInSemester[$key][$totalWeek][$item]);
                            } else {
                                $arrAssignmentInSemester[$key][$totalWeek][$item]['lesson_end'] = (($arrAssignmentInSemester[$key][$totalWeek][$item]['lesson_end'] - $arrAssignmentInSemester[$key][$totalWeek][$item]['lesson_start'] + 1) - $redundantLesson) + $arrAssignmentInSemester[$key][$totalWeek][$item]['lesson_start'] - 1;
                            }
                        }
                    }
                }
            }
        }
        foreach (array_filter($arrAssignmentInSemester) as $key => $AssignmentInSemester) {
            $arrAssignmentInSemester[$key] = array_filter($AssignmentInSemester);
        }
        foreach ($arrAssignmentInSemester as  $AssignmentInSemester) {
            foreach ($AssignmentInSemester as $key =>  $item) {
                foreach ($item as $key => $each) {
                    Assignment::insert($each);
                }
            }
        }
        // dd($arrAssignmentInSemester);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function show($teacher_id)
    {
        return view('assignment.show', compact('teacher_id'));
    }

    public function assigmentsWeekly(Request $request, $teacher_id)
    {
        try {
            $assigments = Assignment::where('teacher_id', $teacher_id)->with('classroom:name,id', 'subject:name,id')
                ->where('date', ">", $request->startDateOfWeek)
                ->where('date', "<", $request->endDateOfWeek)
                ->get();
            // ->toSql();
            return $assigments;
        } catch (\Throwable $th) {
            return abort(404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function edit(Assignment $assignment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Assignment $assignment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Assignment  $assignment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Assignment $assignment)
    {
        //
    }
}
