<?php

namespace App\Http\Middleware;

use App\Enums\TeacherLevelEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainningDepartmentLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::user()->level !== TeacherLevelEnum::PHONG_DAO_TAO)
        {
            return redirect()->route('home')->with('error', 'Bạn không có quyền truy cập vào trang này');
        }
        return $next($request);
    }
}
