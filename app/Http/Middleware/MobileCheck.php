<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileCheck
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
        if (auth()->check() &&  empty(auth()->user()->checkid) && empty(auth()->user()->mobileverified))
        {
            $msg = 'شماره موبایل شما در سیستم احراز نشده است';
            return redirect(route('MobileCheck'))->with('danger',$msg);
        }

        return $next($request);

    }
}
