<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\Order\StoreOrderRequest;

class OrderController extends Controller {
    public function store(StoreOrderRequest $request)
    {
        $result = $request->saveOrder($request->all());

        return response()->json(['order' => $result]);
    }
}
