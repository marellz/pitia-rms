<?php

namespace App\Http\Requests\Stock;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateStockRequest extends FormRequest
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
            'name' => ['string', Rule::unique('stocks')->ignore($this->stock)],
            'description' => 'nullable|string',
            'units' => 'int',
            'unit_type' => 'string|nullable',
            'servings_per_unit' => 'int',
            'cost_per_unit' => 'int'
        ];
    }
}
