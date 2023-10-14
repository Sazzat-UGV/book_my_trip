<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FlightCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "airlines_name" => "required|string|max:100",
            "airlines_model" => "required|string|max:50",
            "departure_time" => "required",
            "from" => "required|string|max:200",
            "to" => "required|string|max:200",
            "total_sit" => "required|numeric",
            "available_sit" => "required|numeric",
            "price" => "required|numeric",
            "flight_date" => "required|date",
        ];
    }
}
