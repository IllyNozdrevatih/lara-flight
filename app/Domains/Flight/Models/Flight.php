<?php

namespace App\Domains\Flight\Models;

use Database\Factories\FlightFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Flight extends Model
{
    use HasFactory;
    protected $fillable = ['from','to', 'airline_id','flight_number','departure_date','arrival_date','gate','seating','flight_time'];

    public function airline(): BelongsTo
    {
        return $this->belongsTo(\App\Domains\Airline\Models\Airline::class, 'airline_id', 'id');
    }

    protected static function newFactory()
    {
        return FlightFactory::new();
    }
}
