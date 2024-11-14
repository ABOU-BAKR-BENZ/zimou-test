<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
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
            'commune_id' => 'nullable|exists:communes,id',
            'store_id' => 'nullable|exists:stores,id',
            'delivery_type_id' => 'nullable|exists:delivery_types,id',
            'status_id' => 'nullable|exists:statuses,id',
            'address' => 'nullable|string|max:255',
            'can_be_opened' => 'nullable|boolean',
            'name' => 'nullable|string|max:100',
            'client_first_name' => 'nullable|string|max:100',
            'client_last_name' => 'nullable|string|max:100',
            'client_phone' => 'nullable|string',
            'client_phone2' => 'nullable|string',
            'cod_to_pay' => 'nullable|numeric|min:0|max:160000',
            'commission' => 'nullable|numeric|min:0|max:50',
            'status_updated_at' => 'nullable|date',
            'delivered_at' => 'nullable|date|after_or_equal:status_updated_at',
            'delivery_price' => 'nullable|numeric|min:5|max:100',
            'extra_weight_price' => 'nullable|numeric|min:0|max:50',
            'free_delivery' => 'nullable|boolean',
            'packaging_price' => 'nullable|numeric|min:0|max:20',
            'partner_cod_price' => 'nullable|numeric|min:0|max:100',
            'partner_delivery_price' => 'nullable|numeric|min:0|max:100',
            'partner_return' => 'nullable|numeric|min:0|max:50',
            'price' => 'nullable|numeric|min:10|max:500',
            'price_to_pay' => 'nullable|numeric|min:0|max:500',
            'return_price' => 'nullable|numeric|min:0|max:50',
            'total_price' => 'nullable|numeric|min:10|max:1000',
            'weight' => 'nullable|integer|min:100|max:5000',
        ];
    }
}
