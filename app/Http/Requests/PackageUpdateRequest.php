<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PackageUpdateRequest extends FormRequest
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
            "category_id" => "required|numeric",
            "package_name" => "required|string|max:255",
            "package_period" => "required|numeric",
            "package_price" => "required|numeric",
            "package_rating" => "required|numeric",
            "starting_date" => "required|date",
            "start_from"=>"required|string|max:50",
            "ending_date" => "required|date",
            "package_details" => "required|string|max:7000",
            "package_image" => "nullable|mimes:png,jpg|max:10240",
            'package_multiple_image' => 'nullable',
            'package_multiple_image.*' => "mimes:png,jpg|max:10240",
        ];
    }
}
