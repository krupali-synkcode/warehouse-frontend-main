<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProfileRequest extends FormRequest
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
        $user = auth()->user()->id;

        return [
            'first_name' => 'required|string|regex:/^[a-zA-Z 0-9\p{L}\p{N}]+$/u|max:50',
            'last_name' => 'required|string|regex:/^[a-zA-Z 0-9\p{L}\p{N}]+$/u|max:50',
            'email' => 'required|email:rfc,dns|max:100|unique:users,email,' . $user,
            'phone_number' => 'required|numeric|digits:10|unique:users,phone_number,' . $user,
        ];
    }

    public function attributes(): array
    {
        return [
            'first_name' => __('First Name'),
            'last_name' => __('Last Name'),
            'email' => __('Email'),
            'phone_number' => __('Phone Number')
        ];
    }
}
