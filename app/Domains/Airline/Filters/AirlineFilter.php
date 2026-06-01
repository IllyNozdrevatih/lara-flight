<?php

namespace App\Domains\Airline\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AirlineFilter
{
    public function __construct(private Request $request)
    {
    }

    public function apply(Builder $query): Builder
    {
        return $query
            ->when($this->request->filled('name'), fn($q) =>
                $q->where('name', 'like', '%' . $this->request->string('name') . '%')
            )
            ->when($this->request->filled('country'), fn($q) =>
                $q->where('country', $this->request->string('country'))
            );
    }
}
