<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'first_name' => 'required|string|regex:/^[a-zA-Z 0-9\p{L}\p{N}]+$/u|max:50',
            'last_name' => 'required|string|regex:/^[a-zA-Z 0-9\p{L}\p{N}]+$/u|max:50',
            'email' => 'required|email:rfc,dns|max:100|unique:users,email',
            'phone_number' => ['required', 'numeric', 'digits:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:100',  'confirmed'],
        ];
    }
}
