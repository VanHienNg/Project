<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::check()) {
            if(Auth::user()->role == 'admin') {
                return $next($request);
            } else { 
                if(request()->is('admin')) {
                    return redirect() -> back() -> with('status', 'You are not allowed to access this page');
                } else {
                    return $next($request);
                }
            }
        } else {
            return redirect('/login') -> with('status', 'You must log in before performing this action!');
        }
    }
}
