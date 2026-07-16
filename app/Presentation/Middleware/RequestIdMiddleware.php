<?php

namespace App\Presentation\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RequestIdMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        $requestId = $request->header('X-Requests-Id') ?: (string) str()->uuid();
        $request->headers->set('X-Requests-Id', $requestId);

        $response = $next($request);
        $response->headers->set('X-Requests-Id', $requestId);

        return $response;
    }
}
