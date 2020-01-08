<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Middleware\CheckBanned as Middleware;

class CheckBanned extends Middleware
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
        $user = auth()->user();

        if ($user && $user->is_ban) {
            return redirect('/')->with('error', 'You had been banned!');
        }

        return $next($request);
    }
}
