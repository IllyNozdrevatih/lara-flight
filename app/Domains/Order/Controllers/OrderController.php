<?php

namespace App\Domains\Order\Controllers;

use App\Domains\Order\Requests\StoreOrderRequest;
use App\Domains\Order\Requests\UpdateOrderRequest;
use App\Domains\Order\Requests\DeleteOrderRequest;
use App\Domains\Order\Services\OrderService;
use App\Shared\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {
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
        } catch (\Throwable $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
