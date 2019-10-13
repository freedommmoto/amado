<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;

class OrderController extends Controller
{
    private $order;
    private $products;

    public function __construct()
    {
        $this->order = new Order();
        $this->products = new Products();
    }

    public function newOrder(Request $request): JsonResponse
    {
        try {
            $this->validateNewOrder($request);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
//        $this->products->reduceStock($product);
//        $this->order->addNewOrder($request, $product);

        return response()->json(['success' => true]);
    }

    private function validateNewOrder(Request $request)
    {
        $this->validate($request, [
            'firstName' => 'required',
            'product' => 'required',
            'email' => 'required|email',
        ]);

        $product = json_decode($request->input('product'));
        if (!isset($product[0]->id)) {
            throw new \Exception('no product in this order');
        }
    }
}
