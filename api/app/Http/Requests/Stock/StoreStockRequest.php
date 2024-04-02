<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequest extends FormRequest
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
            'name' => 'string|required|unique:stocks',
            'description' => 'nullable|string',
            'units' => 'int|required',
            'unit_type' => 'string|nullable',
            'servings_per_unit' => 'int|required',
            'cost_per_unit' => 'int|required'
        ];
    }
}
