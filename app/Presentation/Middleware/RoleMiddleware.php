<?php

namespace App\Presentation\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
                ...$roles
    ): Response
    {

        $user = $request->user();
        if(!$user) abort(403, 'Access denied');

        $userRoles = $user->getAttributeValue('roles');

        if ($userRoles->intersect($roles)->isEmpty()) {
            abort(403, 'Insufficient permissions');
        }

        return $next($request);
    }
}
