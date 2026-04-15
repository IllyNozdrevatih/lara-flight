<?php

namespace Database\Factories;

use App\Models\Flight;
use App\Models\Airline;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Flight>
 */
class FlightFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $departure = fake()->dateTimeBetween('+1 days', '+1 month');

        $arrival = (clone $departure)->modify('+1 day');

        return [
            'from' => fake()->city(),
            'to' => fake()->city(),
            'airline_id' => Airline::factory(),
            'flight_number' => 'F-'.fake()->countryCode(),
            'departure_date' => $departure->format('Y-m-d H:i:s'),
            'arrival_date'   => $arrival->format('Y-m-d H:i:s'),
        ];
    }
}
