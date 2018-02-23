<?php

namespace App\Http\Middleware;

use App\Helper\Custom;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        $authUser = Auth::user();
        if ($authUser->role_id == 5) {
            return redirect('/')->with('message','Sorry, You are not authorized user.');
        } else {
            return $next($request);
        }
    }
}
