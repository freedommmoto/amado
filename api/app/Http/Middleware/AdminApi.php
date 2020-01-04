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
        $token = $request->header('Authorization');

        if (!is_string($token) || empty($token)) {
            return response()->json(['message' => 'Invalid Request. token'], 422);
        }

        if (!User::checkToken($token)) {
            return response()->json(['message' => 'token is now expire'], 422);
        }
        return $next($request);
    }
}
