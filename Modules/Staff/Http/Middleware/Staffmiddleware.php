<?php

namespace Modules\Staff\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class staffmiddleware
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
//        if (Auth::check() && Auth::user()->role == "admin") {
//            return $next($request);
//        } else {
//            return redirect("/home");
//        }
    }
}
