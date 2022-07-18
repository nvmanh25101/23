<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


class TestController extends Controller
{
    public $ControllerName = 'Thử';
    public function __construct()
    {
        $pageTitle =  Route::currentRouteAction();
        $pageTitle = explode('@', $pageTitle)[1];
        view()->share('ControllerName', $this->ControllerName);
        view()->share('pageTitle', $pageTitle);
    }
    public function test()
    {
        $arr = [
            [
                "course_id" => 5,
                "type" => 0,
                "status" => 0,
                "date" => "2022-07-21",
                "lesson_start" => 1,
                "lesson_total" => 5,
            ],
            [
                "course_id" => 5,
                "type" => 0,
                "status" => 0,
                "date" => "2022-07-24",
                "lesson_start" => 1,
                "lesson_total" => 3,
            ]
        ];
        foreach ($arr as $key => $value) {
            dd($arr[0], $value);
        }
    }
}
