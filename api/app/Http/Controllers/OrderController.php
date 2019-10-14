<?php

namespace App\Http\Controllers;

use App\Service\PusherNotification;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Facades\NewOrderFacade;

class OrderController extends Controller
{
    private $pusher;

    private $newOrder;

    /**
     * OrderController constructor.
     */
    public function __construct()
    {
        $this->pusher = new PusherNotification();
        $this->newOrder = new NewOrderFacade();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function newOrder(Request $request): JsonResponse
    {
        try {
            $products = $this->validateNewOrder($request);
            $this->newOrder->process($request, $products);
            $this->pusher->sendUpdateNotificationToUI();

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * @param Request $request
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
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
