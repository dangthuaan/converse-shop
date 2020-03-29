<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
//use App\Http\Middleware\CheckRole as Middleware;

class CheckRole
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
        $user = User::findOrFail(auth()->id());

        if ($user && !($user->isAdmin())) {
            return redirect('/')->with('error', 'You are not Admin of this site!');
        }

        return $next($request);
    }
}
