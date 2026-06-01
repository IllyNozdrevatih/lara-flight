<?php

namespace App\Domains\Flight\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchFlightRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'from'       => 'sometimes|string|min:2|max:100',
            'to'         => 'sometimes|string|min:2|max:100',
            'airline_id' => 'sometimes|integer|exists:airlines,id',
            'date'       => 'sometimes|date',
            'gate'       => 'sometimes|string',
        ];
    }
}
