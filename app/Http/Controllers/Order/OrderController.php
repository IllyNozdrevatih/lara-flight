<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Services\Order\OrderService;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    )
    {
    }

    public function store(StoreOrderRequest $request)
    {
        $result = $this->orderService->store($request);

        return response()->json(['order' => $result]);
    }
}
