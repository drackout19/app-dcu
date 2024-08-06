<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CekLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  mixed  ...$levels
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function handle(Request $request, Closure $next, ...$levels)
    {
        
        if(in_array($request->user()->level, $levels)){
            return $next($request);
        }
        // if (Auth::check()) {
            
        //     $user = $request->user();
        //     if (in_array($request->$user->level, $levels)) {
        //         return $next($request);
        //     }

        //     // User is authenticated but doesn't have the right level
        //     return redirect('login');
        // }

        return redirect('login');
       
        
    }
}