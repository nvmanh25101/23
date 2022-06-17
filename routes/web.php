<?php

use App\Http\Controllers\FacultyController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TestController;
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

Route::get('/', function () {
    return view('layouts.master');
})->name('home');


Route::get('/login', function () {
    return view('login');
});

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
    'as'     => 'subjects.',
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
    Route::get('/', [TestController::class, 'edit']);
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
