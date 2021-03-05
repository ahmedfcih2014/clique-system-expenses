<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ManagerRole
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
        if (auth()->user()->role != 'manager')
            return redirect(route('expenses.index'))->with('warning' ,'You are not allowed for this action');
        return $next($request);
    }
}
