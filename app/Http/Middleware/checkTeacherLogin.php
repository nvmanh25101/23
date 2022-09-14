<?php

namespace App\Http\Middleware;

use App\Enums\TeacherLevelEnum;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class checkTeacherLogin
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
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->level == TeacherLevelEnum::GIANG_VIEN || $user->level == TeacherLevelEnum::TRUONG_KHOA) {
                return $next($request);
            }
            Auth::logout();
            return redirect()->route('login');
        }

        return redirect('login');
    }
}
