<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCartRequest extends FormRequest
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
            "warehouse_id" => "required|uuid",
            "check_in_date" => "required|date|date_format:Y-m-d H:i|after_or_equal:today",
            "check_out_date" => "required|date|date_format:Y-m-d H:i|after:start_date",
            "notes" => "nullable|string"
        ];
    }
}
