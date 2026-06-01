<?php

namespace App\Domains\Airline\Jobs;

use App\Domains\Airline\Models\Airline;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessAirlineData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Airline $airline)
    {
    }

    public function handle(): void
    {
        // Process airline data
    }
}
