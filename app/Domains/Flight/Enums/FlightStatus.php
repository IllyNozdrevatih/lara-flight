<?php

namespace App\Domains\Flight\Enums;

enum FlightStatus: string
{
    case Scheduled  = 'scheduled';
    case Boarding   = 'boarding';
    case Departed   = 'departed';
    case Arrived    = 'arrived';
    case Cancelled  = 'cancelled';
    case Delayed    = 'delayed';
}
