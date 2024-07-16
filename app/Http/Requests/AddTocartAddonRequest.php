<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddTocartAddonRequest extends FormRequest
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
            "action" => "required|In:remove,add",
            "added_cart_addon_id" => "required_if:action,remove",
            "cart_id" => "required|uuid",
            "addon_id" => "required|uuid"
        ];
    }
}
