<?php
return [
    'api_key'  => env('GEODB_API_KEY'),
    'base_url' => env('GEODB_BASE_URL', 'https://wft-geo-db.p.rapidapi.com/v1/geo'),
    'host'     => env('GEODB_HOST', 'wft-geo-db.p.rapidapi.com'),
    'timeout'  => 10,
    'language_code' => 'en',
    'default_limit' => env('GEODB_DEFAULT_LIMIT', 5),
    'cache_ttl' => 60 * 60 * 24,
];
