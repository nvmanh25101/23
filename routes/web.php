<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseDetailController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TrainingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
    'middleware' => 'checkAdminLogin'
], static function () {
    Route::get('/', function () {
        return view('layouts.home');
    })->name('home');

    Route::get('/load-subject/{faculty_id?}', [AjaxController::class, 'loadSubject'])->name('loadSubject');

    Route::get('/load-teacher/{faculty_id?}', [AjaxController::class, 'loadTeacher'])->name('loadTeacher');
    Route::get('/load-facultyName/faculty_name', [AjaxController::class, 'loadFaculty'])->name('loadFacultyName');

    Route::get('/load-subject-from-classroom/{classroom?}',
        [AjaxController::class, 'loadSubjectFromClassRoom'])->name('loadSubjectFromClassRoom');

    Route::get('/countClassRoom/{major_id?}', [AjaxController::class, 'countClassRoom'])->name('countClassRoom');

    Route::get('/getSemester/{training_id?}', [AjaxController::class, 'getSemester'])->name('getSemester');

    Route::get('/chuong-trinh-khung/tim-kiem/{classroom_id?}',
        [AjaxController::class, 'loadPlanFromClassRoom'])->name('loadPlanFromClassRoom');

    Route::prefix('faculty')->name('faculty.')->group(function () {
        Route::get('/', [FacultyController::class, 'index'])->name('index');
        Route::get('/api', [FacultyController::class, 'api'])->name('api');
        Route::get('/show/{id?}', [FacultyController::class, 'show'])->name('show');
        //
        Route::get('/add', function () {
            return abort(404);
        });
        Route::post('/add', [FacultyController::class, 'store'])->name('store');
        //
        Route::get('/edit', function () {
            return abort(404);
        });
        Route::post('/edit', [FacultyController::class, 'update'])->name('update');
        //
        Route::get('/delete', function () {
            return abort(404);
        });
        Route::delete('/delete', [FacultyController::class, 'destroy'])->name('destroy');
    });

    Route::group([
        'as' => 'subjects.',
        'prefix' => 'subjects',
    ], static function () {
        Route::get('/', [SubjectController::class, 'index'])->name('index');
        Route::get('/api', [SubjectController::class, 'api'])->name('api');
        Route::get('/create', [SubjectController::class, 'create'])->name('create');
        Route::post('/store', [SubjectController::class, 'store'])->name('store');
        Route::get('/edit/{subject}', [SubjectController::class, 'edit'])->name('edit');
        Route::put('/edit/{subject}', [SubjectController::class, 'update'])->name('update');
        Route::delete('/destroy/{subject}', [SubjectController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('test')->name('test.')->group(function () {
        Route::get('/', [TestController::class, 'test']);
    });


    Route::prefix('major')->name('major.')->group(function () {
        Route::get('/', [MajorController::class, 'index'])->name('index');
        Route::get('/api', [MajorController::class, 'api'])->name('api');
        Route::get('/show/{id?}', [MajorController::class, 'show'])->name('show');
        //
        Route::get('/add', function () {
            return abort(404);
        });
        Route::post('/add', [MajorController::class, 'store'])->name('store');
        //
        Route::get('/edit', function () {
            return abort(404);
        });
        Route::post('/edit', [MajorController::class, 'update'])->name('update');
        //
        Route::get('/delete', function () {
            return abort(404);
        });
        Route::delete('/delete', [MajorController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('academic-year')->name('academicYear.')->group(function () {
        Route::get('/', [AcademicYearController::class, 'index'])->name('index');
        Route::get('/api', [AcademicYearController::class, 'api'])->name('api');
        Route::get('/show/{id?}', [AcademicYearController::class, 'show'])->name('show');
        //
        Route::get('/add', function () {
            return abort(404);
        });
        Route::post('/add', [AcademicYearController::class, 'store'])->name('store');
        //
        Route::get('/edit', function () {
            return abort(404);
        });
        Route::post('/edit', [AcademicYearController::class, 'update'])->name('update');
        //
        Route::get('/delete', function () {
            return abort(404);
        });
        Route::delete('/delete', [AcademicYearController::class, 'destroy'])->name('destroy');
    });

    Route::group([
        'as' => 'teachers.',
        'prefix' => 'teachers',
    ], static function () {
        Route::get('/', [TeacherController::class, 'index'])->name('index');
        Route::get('/api', [TeacherController::class, 'api'])->name('api');
        Route::get('/create', [TeacherController::class, 'create'])->name('create');
        Route::post('/store', [TeacherController::class, 'store'])->name('store');
        Route::get('/edit/{teacher}', [TeacherController::class, 'edit'])->name('edit');
        Route::put('/edit/{teacher}', [TeacherController::class, 'update'])->name('update');
        Route::delete('/destroy/{teacher}', [TeacherController::class, 'destroy'])->name('destroy');
        Route::post('/import-csv', [TeacherController::class, 'importCsv'])->name('import_csv');
    });

    Route::prefix('classroom')->name('classroom.')->group(function () {
        Route::get('/', [ClassroomController::class, 'index'])->name('index');
        Route::get('/api', [ClassroomController::class, 'api'])->name('api');
        Route::get('/show/{id?}', [ClassroomController::class, 'show'])->name('show');
        //
        Route::get('/add', function () {
            return abort(404);
        });
        Route::post('/add', [ClassroomController::class, 'store'])->name('store');
        //
        Route::get('/edit', function () {
            return abort(404);
        });
        Route::post('/edit', [ClassroomController::class, 'update'])->name('update');
        //
        Route::get('/delete', function () {
            return abort(404);
        });
        Route::delete('/delete', [ClassroomController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('course')->name('course.')->group(function () {
        Route::get('/', [CourseController::class, 'index'])->name('index');
        Route::get('/api', [CourseController::class, 'api'])->name('api');
        Route::get('/show/{id?}', [CourseController::class, 'show'])->name('show');


        Route::get('/add', [CourseController::class, 'create'])->name('add');
        Route::post('/add', [CourseController::class, 'store'])->name('store');

        Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('edit');
        Route::post('/edit/{course}', [CourseController::class, 'update'])->name('update');

        Route::delete('/delete', [CourseController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('course-detail')->name('courseDetail.')->group(function () {
        Route::get('/', [CourseDetailController::class, 'index'])->name('index');
        Route::get('/api', [CourseDetailController::class, 'api'])->name('api');
        Route::get('/show/{id?}', [CourseDetailController::class, 'show'])->name('show');

        Route::get('/add', [CourseDetailController::class, 'create'])->name('add');
        Route::post('/add', [CourseDetailController::class, 'store'])->name('store');

        Route::get('/edit', [CourseDetailController::class, 'edit'])->name('edit');
        Route::post('/edit', [CourseDetailController::class, 'update'])->name('update');

        Route::delete('/delete', [CourseDetailController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('semester')->name('semester.')->group(function () {
        Route::get('/', [SemesterController::class, 'index'])->name('index');
        Route::get('/api', [SemesterController::class, 'api'])->name('api');
        Route::get('/show/{id?}', [SemesterController::class, 'show'])->name('show');
        //
        Route::get('/add', function () {
            return abort(404);
        });
        Route::post('/add', [SemesterController::class, 'store'])->name('store');
        //
        Route::get('/edit', function () {
            return abort(404);
        });
        Route::post('/edit', [SemesterController::class, 'update'])->name('update');
        //
        Route::get('/delete', function () {
            return abort(404);
        });
        Route::delete('/delete', [SemesterController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('he-dao-tao')->name('training.')->group(function () {
        Route::get('/danh-sach', [TrainingController::class, 'index'])->name('index');
        Route::get('/api', [TrainingController::class, 'api'])->name('api');
        Route::get('/show/{id?}', [TrainingController::class, 'show'])->name('show');
        //
        Route::get('/them-moi', function () {
            return abort(404);
        });
        Route::post('/them-moi', [TrainingController::class, 'store'])->name('store');
        //
        Route::get('/chinh-sua', function () {
            return abort(404);
        });
        Route::post('/chinh-sua', [TrainingController::class, 'update'])->name('update');
        //
        Route::get('/xoa', function () {
            return abort(404);
        });
        // Route::delete('/xoa', [TrainingController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('he-dao-tao')->name('training.')->group(function () {
        Route::get('/danh-sach', [TrainingController::class, 'index'])->name('index');
        Route::get('/api', [TrainingController::class, 'api'])->name('api');
        Route::get('/show/{id?}', [TrainingController::class, 'show'])->name('show');
        //
        Route::get('/them-moi', function () {
            return abort(404);
        });
        Route::post('/them-moi', [TrainingController::class, 'store'])->name('store');
        //
        Route::get('/chinh-sua', function () {
            return abort(404);
        });
        Route::post('/chinh-sua', [TrainingController::class, 'update'])->name('update');
        //
        Route::get('/xoa', function () {
            return abort(404);
        });
        // Route::delete('/xoa', [TrainingController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('chuong-trinh-khung')->name('plan.')->group(function () {
        Route::get('/', [PlanController::class, 'index'])->name('index');
        Route::get('/api', [PlanController::class, 'api'])->name('api');
        Route::get('/chi-tiet/{classroom_id?}', [PlanController::class, 'show'])->name('show');


        Route::get('/them-moi', [PlanController::class, 'create'])->name('add');
        Route::post('/them-moi', [PlanController::class, 'store'])->name('store');

        Route::get('/chinh-sua/{plan}', [PlanController::class, 'edit'])->name('edit');
        Route::post('/chinh-sua/{plan}', [PlanController::class, 'update'])->name('update');

        Route::delete('/delete', [PlanController::class, 'destroy'])->name('destroy');
    });


    Route::prefix('phan-cong-giang-day')->name('assignment.')->group(function () {
        Route::get('/', [AssignmentController::class, 'index'])->name('index');

        Route::get('/tim-lop', [AssignmentController::class, 'findClass'])->name('findClass');

        Route::get('/api', [AssignmentController::class, 'api'])->name('api');
        Route::get('/chi-tiet/{teacher_id}', [AssignmentController::class, 'show'])->name('show');
        Route::get('/lich-day-theo-tuan/{teacher_id?}',
            [AssignmentController::class, 'assigmentsWeekly'])->name('assigmentsWeekly');

        // Route::get('/tim-kiem/{teacher_id}', [AssignmentController::class, 'show'])->name('show');

        Route::get('/add', [AssignmentController::class, 'create'])->name('add');
        Route::post('/add', [AssignmentController::class, 'store'])->name('store');

        Route::get('/edit', [AssignmentController::class, 'edit'])->name('edit');
        Route::post('/edit', [AssignmentController::class, 'update'])->name('update');

        Route::delete('/delete', [AssignmentController::class, 'destroy'])->name('destroy');
    });
});

