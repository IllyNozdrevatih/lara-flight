<?php

namespace App\Http\Requests\Flight;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class  UpdateFlightRequest extends FormRequest
{

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors'  => $validator->errors(),
            ], 422)
        );
    }
    public function rules(): array
    {
        return [
            'from'           => 'sometimes|string',
            'to'             => 'sometimes|string',
            'flight_number'  => 'sometimes|string',
            'departure_date' => 'sometimes|nullable|date',
            'arrival_date'   => 'sometimes|nullable|date',
            'gate'           => 'sometimes|string',
            'seating'        => 'sometimes|integer',
            'flight_time'    => 'sometimes|string',
            'airline_id' => [
                'required',
                'integer',
                'min:1',
                Rule::exists('airlines', 'id'),
            ],
        ];
    }

}
