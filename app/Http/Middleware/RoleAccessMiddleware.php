<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  mixed  ...$roles
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next, ...$allowedRoleIds): Response
{
    $user = Auth::user();

    if (!$user || !$user->roles_id) {
        abort(403, 'Access denied');
    }

    // Bandingkan roles_id
    if (!in_array($user->roles_id, $allowedRoleIds)) {
        abort(403, 'Unauthorized access.');
    }

    return $next($request);
}


}