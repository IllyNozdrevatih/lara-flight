<?php

namespace App\Services\Order;


use App\Http\Requests\Order\StoreOrderRequest;
use App\Models\Flight;
use App\Models\Order;
use App\Models\User;
use App\Notifications\NotifyUserSaveOrder;
use Illuminate\Support\Arr;

class OrderService {
    public function store( StoreOrderRequest $request)
    {
        $user = $request->user();

        $order = Order::create([
            'flight_id' => $request->flight_id,
            'user_id'   => $user->id,
        ]);

        $user->notify(new NotifyUserSaveOrder($user->name, $order->id));

        return $order;
    }
}
