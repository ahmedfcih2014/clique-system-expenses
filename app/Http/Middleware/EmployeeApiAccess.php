<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EmployeeApiAccess
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
        if ($request->has('user_id')) {
            $employee = User::find($request->user_id);
            if ($employee && $employee->role == 'employee') {
                $request->merge(['employee' => $employee]);
                return $next($request);
            }
        }
        return response(['message' => 'You are not allowed to perform this action'] ,Response::HTTP_BAD_REQUEST);
    }
}
