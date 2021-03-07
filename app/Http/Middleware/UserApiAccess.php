<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserApiAccess
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
            $user = User::find($request->user_id);
            if ($user) {
                if ($user->role == 'manager')
                    $request->merge(['manager' => $user]);
                else
                    $request->merge(['employee' => $user]);
                return $next($request);
            }
        }
        return response(['message' => 'You are not allowed to perform this action'] ,Response::HTTP_BAD_REQUEST);
    }
}
