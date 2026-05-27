<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\DeleteOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
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
        try {
            $result = $this->orderService->store($request);

            return response()->json(['order' => $result]);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function update(UpdateOrderRequest $request)
    {
        try {
            $result = $this->orderService->update($request);

            return response()->json(['order' => $result]);
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function delete(DeleteOrderRequest $request)
    {
        try {
            $result = $this->orderService->delete($request);

            return response()->json(['result' => $result]);
        }  catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }


}
