<?php
// app/Filters/FlightFilter.php
namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class FlightFilter
{
    public function __construct(private Request $request) {}

    public function apply(Builder $query): Builder
    {
        return $query
            ->when($this->request->filled('from'), fn($q) =>
            $q->where('from', 'like', '%' . $this->request->string('from') . '%')
            )
            ->when($this->request->filled('to'), fn($q) =>
            $q->where('to', 'like', '%' . $this->request->string('to') . '%')
            )
            ->when($this->request->filled('airline_id'), fn($q) =>
            $q->where('airline_id', $this->request->integer('airline_id'))
            )
            ->when($this->request->filled('date'), fn($q) =>
            $q->whereDate('departure_date', $this->request->string('date'))
            )
            ->when($this->request->filled('gate'), fn($q) =>
            $q->where('gate', $this->request->string('gate'))
            );
    }
}
