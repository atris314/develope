<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ProfileCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if (Auth::user()->isClient()){
                return $next($request);
            }
        }
        $msg = 'برای ثبت سفارش ابتدا باید اطلاعات پروفایل خود را تکمیل بفرمایید';
        return redirect(route('profileedite',Auth::user()->id))->with('danger',$msg);
    }
}
