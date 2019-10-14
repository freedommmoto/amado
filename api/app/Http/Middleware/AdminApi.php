<?php

namespace App\Http\Middleware;
use App\Models\User;

use Closure;

class AdminApi
{
    /**
     * @param $request
     * @param Closure $next
     * @return \Illuminate\Http\JsonResponse|mixed
     */
    public function handle($request, Closure $next)
    {
        $userName = $request->header('userName') ?? $request->input('userName');
        $token = $request->header('token') ?? $request->input('token');

        if (!is_string($userName)) {
            return response()->json(['message' => 'Invalid Request. userName'], 422);
        }
        if (!is_string($token)) {
            return response()->json(['message' => 'Invalid Request. token'], 422);
        }

        if (!User::checkTokenIsMatch($userName, $token)) {
            return response()->json(['message' => 'token is now expire'], 422);
        }
        return $next($request);
    }
}
