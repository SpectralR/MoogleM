<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminModo
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
//        dd($request);
        $user = Auth::user();
        $roles = $user->roles()->get();
        if ($roles->contains('1') || $roles->contains('2'))
        {
            return $next($request);
        }

        return redirect()->route('home');
    }
}
