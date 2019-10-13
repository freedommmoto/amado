<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
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
    }

    public function newOrder(Request $request): JsonResponse
    {
        try {
            $products = $this->validateNewOrder($request);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
        //$this->products::reduceStock($products);
        $orderID = Order::addNewOrder($request);
        OrderProduct::addNewOrderProduct($products, $orderID);

        return response()->json(['success' => true]);
    }

    private function validateNewOrder(Request $request): array
    {
        $this->validate($request, [
            'firstName' => 'required',
            'product' => 'required',
            'email' => 'required|email',
        ]);

        $products = json_decode($request->input('product'), false);
        if (!isset($products[0]->id)) {
            throw new \Exception('no product in this order');
        }
        return $products;
    }
}
