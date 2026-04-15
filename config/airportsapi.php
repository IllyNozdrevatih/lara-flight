<?php
return [
    'api_key'  => env('AIRPORTS_API_KEY'),
    'base_url' => env('AIRPORTS_BASE_URL', 'https://airports.p.rapidapi.com/v1/'),
    'host'     => env('AIRPORTS_HOST', 'airports.p.rapidapi.com'),
];
