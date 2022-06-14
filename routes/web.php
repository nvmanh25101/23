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

Route::prefix('faculties')->name('faculties.')->group(function () {
    Route::get('/', [FacultyController::class, 'index'])->name('index');
    Route::get('/api', [FacultyController::class, 'api'])->name('api');
    Route::post('/add', [FacultyController::class, 'store'])->name('store');
    Route::get('/edit/{faculty}', [FacultyController::class, 'edit'])->name('edit');
});
