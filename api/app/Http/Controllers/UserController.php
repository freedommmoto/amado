<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class UserController extends Controller
{

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request): JsonResponse
    {
        $this->validate($request, [
            'userName' => 'required|min:2|max:40',
            'passWord' => 'required|min:2|max:40'
        ]);

        $userName = $request->input('userName');
        $passWord = $request->input('passWord');

        $userData = User::processLogin($userName, $passWord);
        if (!empty($userData)) {
            return response()->json(['success' => true, 'userData' => $userData]);
        }

        return response()->json(['success' => false, 'userData' => []]);
    }

    public function profile(): JsonResponse
    {
        return response()->json(['success' => true, 'user' => Auth::user()]);
    }

}
