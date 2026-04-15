<?php

namespace App\Http\Requests\Flight;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreFlightRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
//    public function authorize(): bool
//    {
//        return false;
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'from' => 'required|string|min:2|max:100',
            'to' => 'required|string|min:2|max:100',
            'airline_id' => [
                'required',
                'integer',
                'min:1',
                Rule::exists('airlines', 'id'),
            ],
        ];
    }
}
