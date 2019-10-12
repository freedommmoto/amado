<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function uploadImage(Request $request): JsonResponse
    {
        if ($request->hasFile('image')) {
            $destinationPath = storage_path('img');
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $imageName);
            return response()->json(['success' => true, 'part' => env('API_URL') . '/img/' . $imageName]);
        }
    }
}
