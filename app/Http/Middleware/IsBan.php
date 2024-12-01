<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Auth;
use Inertia\Inertia;

class IsBan
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user() &&  Auth::user()->is_ban == 0) {
            return $next($request);
        }
        elseif (!Auth::check()) {
            return $next($request);
        }
        else{
            // $response = response()->Inertia::render('BannedPage');
            // $response->withCookie(cookie('name', 'value', 60));
            return Inertia::render('BannedPage');
        }
    }
}