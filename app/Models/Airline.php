<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Airline extends Model
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    protected $fillable = ['name','address', 'country','email','phone'];


    public function flights(): HasMany
    {
        return $this->hasMany(Flight::class,'airline_id','id');
    }
}

