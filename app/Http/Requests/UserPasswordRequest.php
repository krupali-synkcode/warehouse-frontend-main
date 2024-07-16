<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'password' => 'required|min:8|max:100|string|regex:/^(?=.*[A-Z])(?=.*\d).{8,}$/|confirmed|different:current_password',
            'password_confirmation' => 'required|min:8|max:100|string',
        ];
    }

    public function attributes(): array
    {
        return [
            'current_password' => __('Current Password'),
            'password' => __('New Password'),
            'password_confirmation' => __('Confirm Password'),
        ];
    }
}
