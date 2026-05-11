<?php

namespace App\Services\Order;


use App\Models\Flight;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Arr;

class OrderService {
    public function saveOrder( array  $data)
    {

        $payload = Arr::only($data,['flight_id','user_id']);

        $order = Order::create($payload);

        return $order;
    }
}
