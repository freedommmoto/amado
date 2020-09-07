<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{

    /**
     * Get a JWT via given credentials.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        //validate incoming request
        $this->validate($request, [
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (!$token = Auth::attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $userSession = Auth::user();
        $user = User::where('id', $userSession->id)->first();

        if ($user) {
            $user->last_login = Carbon::now();
            $user->save();
        }
        return $this->respondWithToken($token);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        try {
            $userSession = Auth::user();
            $user = User::where('id', $userSession->id)->first();
            if ($user) {
                $user->last_logout = Carbon::now();
                $user->save();
            }

            Auth::logout();
            return response()->json(['success' => true]);
        } catch (Exception $e) {
            return response()->json(['success' => false]);
        }
    }
}