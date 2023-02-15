<?php

namespace App\Http\Middleware;

use App\Exceptions\APIException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, $roles)
    {
        if (!$request->user()->hasRole(explode('|', $roles))) {
            throw new APIException(403, 'Forbidden for you');
        }
        return $next($request);
    }
}
