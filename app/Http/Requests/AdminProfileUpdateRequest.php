<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AdminProfileUpdateRequest extends FormRequest
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
        $user_id = Auth::user()->id;
        return [
            "full_name" => "required|string|max:255",
            "email" => [
                'required',
                'email',
                'max:255',
                Rule::unique('users')->ignore($user_id),
            ],
            "phone" => "required|numeric",
            "address" => "required|string|max:255",
        ];
    }
}
