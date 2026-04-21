<?php

namespace App\Http\Requests\Airline;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateAirlineRequest extends FormRequest
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
    public function rules(){
        return [
            'name' => 'sometimes|unique:airlines|string|min:2|max:255',
            'country' => 'sometimes|string|min:2|max:255',
            'email' => 'email|min:2|max:255',
            'address' => 'required|sometimes|string|min:2|max:255',
            'phone' => 'required|sometimes|string|min:2|max:255',
        ];
    }
}
