<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PersonalAccountMiddleware
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
        session()->put('guest_loc_id', auth()->user()->locations);
        session()->put('guest_id', auth()->user()->id);
        return $next($request);
    }
}
