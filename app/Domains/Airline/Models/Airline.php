<?php

namespace App\Domains\Airline\Models;

use Database\Factories\AirlineFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    use HasFactory;
    protected $fillable = ['name','address', 'country','email','phone'];

    public function flights(): HasMany
    {
        return $this->hasMany(\App\Domains\Flight\Models\Flight::class, 'airline_id', 'id');
    }

    protected static function newFactory()
    {
        return AirlineFactory::new();
    }
}
