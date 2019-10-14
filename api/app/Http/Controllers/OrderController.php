<?php

namespace App\Http\Controllers;

use App\Models\OrderProduct;
use App\Service\PusherNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;

class OrderController extends Controller
{

    public function newOrder(Request $request): JsonResponse
    {
        try {
            $products = $this->validateNewOrder($request);
            if (!Products::reduceStock($products)) {
                throw new \Exception('stock is not enough');
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
        $orderID = Order::addNewOrder($request);
        OrderProduct::addNewOrderProduct($products, $orderID);
        $pusher = new PusherNotification();
        $pusher->sendUpdateNotificationToUI();
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
        $firstProduct = reset($products);

        if (!isset($firstProduct->id_product)) {
            throw new \Exception('no product in this order');
        }
        return $products;
    }
}
