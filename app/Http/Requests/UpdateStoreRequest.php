<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStoreRequest extends FormRequest
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
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phones' => ['nullable', 'string', 'regex:/^(05|06|07)[0-9]{8}$/'],
            'company_name' => 'nullable|string|max:255',
            'capital' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'register_commerce_number' => 'nullable|string|max:255',
            'nif' => 'nullable|string|max:255',
            'legal_form' => 'nullable|integer',
            'status' => 'nullable|integer|in:0,1',
            'can_update_preparing_packages' => 'nullable|boolean',
        ];
    }
}
