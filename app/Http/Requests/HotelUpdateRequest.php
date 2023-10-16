<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelUpdateRequest extends FormRequest
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
            "hotel_name" =>"required|string|max:255",
            "hotel_location" =>"required|string|max:255",
            "room_price" => "required|numeric",
            "hotel_rating" => "required|numeric",
            "room_type" => "required|string|max:50",
            "hotel_details" =>"required|string|max:7000",
            "hotel_image" =>"nullable|mimes:png,jpg|max:10240",
            'hotel_multiple_image' => 'nullable',
            'hotel_multiple_image.*' => "mimes:png,jpg|max:10240",
        ];
    }
}
