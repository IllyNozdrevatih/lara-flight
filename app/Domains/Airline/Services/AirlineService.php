<?php

namespace App\Domains\Airline\Services;

use App\Domains\Airline\Models\Airline;
use Illuminate\Support\Arr;

class AirlineService
{
    public function update(int $id, array $data)
    {
        $airline = Airline::findOrFail($id);
        $airline->update(Arr::only($data, ['name', 'address', 'country', 'email', 'phone']));
        return $airline;
    }

    public function delete(int $id): void
    {
        $airline = Airline::findOrFail($id);
        $airline->flights()->delete();
        $airline->delete();
    }
}
