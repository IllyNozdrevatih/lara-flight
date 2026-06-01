<?php

namespace App\Domains\Order\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'flight_id',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Domains\User\Models\User::class);
    }

    public function flight()
    {
        return $this->belongsTo(\App\Domains\Flight\Models\Flight::class);
    }
}
