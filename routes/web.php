<?php

use App\Http\Controllers\FacultyController;
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
});


Route::get('/login', function () {
    return view('login');
});

Route::prefix('faculty')->name('faculty.')->group(function () {
    Route::get('/', [FacultyController::class, 'index']);
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
