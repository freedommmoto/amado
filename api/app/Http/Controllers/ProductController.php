<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Products;

class ProductController extends Controller
{

    public function getAll()
    {
        $products = Products::orderBy('id_product')->get(['id_product', 'name', 'stock', 'price', 'show']);
        return response()->json(['products' => $products]);
    }

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
