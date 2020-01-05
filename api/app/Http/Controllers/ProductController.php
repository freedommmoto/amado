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

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function add(Request $request): JsonResponse
    {
        $product = new Products();

        try {
            $this->validate($request, [
                'name' => 'required|string|min:2|max:40',
                'price' => 'required|int',
                'quantity' => 'required|int',
                'image' => 'required'
            ]);

            if (!$request->hasFile('image')) {
                return response()->json(['success' => false, 'error' => 'no product file']);
            }

            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->stock = $request->input('quantity');
            $product->save();

            $destinationPath = storage_path('img');
            $imageName = $product->id_product . '.' . $request->image->getClientOriginalExtension();
            $request->image->move($destinationPath, $imageName);

            return response()->json(['success' => true, 'part' => env('API_URL') . '/img/' . $imageName]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }

    }

}
