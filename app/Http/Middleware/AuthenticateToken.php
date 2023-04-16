<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use JWTAuth;
use Exception;

class AuthenticateToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    if (! $request->header('Authorization')) {
        return response()->json(['error' => 'Authorization header missing'], 401);
    }

    $token = $request->header('Authorization');

    try {
        $user = JWTAuth::parseToken()->authenticate($token);
    } catch (Exception $e) {
        return response()->json(['error' => 'Invalid token'], 401);
    }

    return $next($request);
}

}
