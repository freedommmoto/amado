<?php

namespace App\Facades;

use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Products;

class NewOrderFacade
{
    /**
     * @param Request $request
     * @param array $products
     * @throws \Exception
     */
    public function process(Request $request, array $products): void
    {

        if (!Products::reduceStock($products)) {
            throw new \Exception('stock is not enough');
        }

        $orderID = Order::addNewOrder($request);
        if ($orderID < 1) {
            throw new \Exception('enable to add new order');
        }

        if (!OrderProduct::addNewOrderProduct($products, $orderID)) {
            throw new \Exception('enable to add new product list in this order');
        }

    }

}
