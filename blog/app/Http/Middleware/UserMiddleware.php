<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class UserMiddleware
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
        if (Auth::user()->role == 'user')
        {
            return $next($request); //pour faire passer uniquement l'admin 
        }
        else 
        {
            Auth::logout(); //detruire l'utilisateur
            Session::flush(); //detruire sa session 
            return redirect()->route('login');
        }


        return $next($request);
    }
}
