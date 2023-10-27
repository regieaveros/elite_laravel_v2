<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class UsertypeMiddleware
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
        if (Auth::check()) { // Check if a user is logged in
            $userData = DB::table('users')
                ->join('usertypes', 'users.usertype_id', '=', 'usertypes.id')
                ->select('usertypes.restriction')
                ->where('users.id', Auth::id())
                ->first();

            if ($userData) {

                Session::put('restrictions', $userData);
            }
        }

        return $next($request);
    }
}
