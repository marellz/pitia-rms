<?php

namespace App\Http\Requests\Supplies;

use Illuminate\Foundation\Http\FormRequest;

class StoreSuppliesRequest extends FormRequest
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
            "name" => 'required|string|max:255',
            "description" => 'string|nullable',
            "units"=> 'int',
            "servings_per_unit" => 'required|int',
            'cost_per_unit' => 'required|int',

        ];
    }
}
