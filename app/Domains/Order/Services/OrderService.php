<?php

namespace App\Domains\Order\Services;

use App\Domains\Order\Models\Order;
use App\Domains\Order\Requests\DeleteOrderRequest;
use App\Domains\Order\Requests\StoreOrderRequest;
use App\Domains\Order\Requests\UpdateOrderRequest;
use App\Notifications\NotifyUserSaveOrder;
use Illuminate\Support\Facades\Gate;

class OrderService
{
    public function store(StoreOrderRequest $request)
    {
        $user = $request->user();

        $order = Order::create([
            'flight_id' => $request->flight_id,
            'user_id'   => $user->id,
        ]);

        $user->notify(new NotifyUserSaveOrder($user->name, $order->id));

        return $order;
    }

    public function update(UpdateOrderRequest $request)
    {
        $order = Order::findOrFail($request->order_id);
        Gate::authorize('update', $order);
        $order->flight_id = $request->flight_id;
        $order->save();

        return $order;
    }

    public function delete(DeleteOrderRequest $request)
    {
        $order = Order::findOrFail($request->order_id);
        Gate::authorize('delete', $order);
        return $order->delete();
    }
}
