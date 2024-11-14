<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStoreRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phones' => 'required|string',
            'company_name' => 'nullable|string|max:255',
            'capital' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'register_commerce_number' => 'nullable|string|max:255',
            'nif' => 'nullable|string|max:255',
            'legal_form' => 'nullable|integer',
            'status' => 'nullable|integer|in:1,2',
            'can_update_preparing_packages' => 'nullable|boolean',
        ];
    }
}
