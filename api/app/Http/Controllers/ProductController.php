<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Products;
use Illuminate\Support\Facades\Redis;

class ProductController extends Controller
{
    public function getAll()
    {
        $cached = Redis::get('products');
        if (!$cached) {
            $products = Products::orderBy('id_product')->get(['id_product', 'name', 'stock', 'price', 'show']);
            Redis::set('products', json_encode($products));
            Redis::expire('products', 3600);
        } else {
            $products = json_decode($cached);
        }

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
        try {

            $this->validateProduct($request);
            $productID = Products::addNewProducts($request);
            $imageName = $this->saveProductImage($productID, $request);
            Products::clearCached();

            return response()->json(['success' => true, 'part' => env('API_URL') . '/img/' . $imageName]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateProduct(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|min:2|max:40',
            'price' => 'required|int',
            'stock' => 'required|int',
            'image' => 'required'
        ]);

        if (!$request->hasFile('image')) {
            throw new \Exception('no product file');
            //return response()->json(['success' => false, 'error' => 'no product file']);
        }
    }

    /**
     * @param int $productID
     * @param Request $request
     * @return string
     */
    private function saveProductImage(int $productID, Request $request): string
    {
        $destinationPath = storage_path('img');
        //$imageName = $productID . '.' . $request->image->getClientOriginalExtension();
        $imageName = $productID . '.' . 'jpg';
        $request->image->move($destinationPath, $imageName);
        return $imageName;
    }
}
