<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePackageRequest extends FormRequest
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
            'commune_id' => 'required|exists:communes,id',
            'store_id' => 'required|exists:stores,id',
            'delivery_type_id' => 'required|exists:delivery_types,id',
            'address' => 'required|string|max:255',
            'can_be_opened' => 'required|boolean',
            'name' => 'required|string|max:100',
            'client_first_name' => 'required|string|max:100',
            'client_last_name' => 'required|string|max:100',
            'client_phone' => 'required|string|min:10|max:15',
            'client_phone2' => 'nullable|string|min:10|max:15',
            'cod_to_pay' => 'required|numeric|min:0|max:1000',
            'free_delivery' => 'required|boolean',
            'weight' => 'required|integer|min:1000|max:5000',
        ];
    }
}