<?php

namespace App\Services\Order;


use App\Http\Requests\Order\DeleteOrderRequest;
use App\Http\Requests\Order\StoreOrderRequest;
use App\Http\Requests\Order\UpdateOrderRequest;
use App\Models\Order;
use App\Notifications\NotifyUserSaveOrder;
use Illuminate\Support\Facades\Gate;

class OrderService {
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

    public function update(UpdateOrderRequest $request){
        $order = Order::findOrFail($request->order_id);
        Gate::authorize('update', $order);
        $order->flight_id = $request->flight_id;
        $order->save();

        return $order;
    }
    public function delete(DeleteOrderRequest $request){
        $order = Order::findOrFail($request->order_id);
        Gate::authorize('delete', $order);
        return $order->delete();
    }
}
