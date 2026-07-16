<?php

namespace App\Presentation\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiExceptionHandler
{
    public function handle(Request $request, Closure $next): Response
    {
        try {
            return $next($request);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }
}
