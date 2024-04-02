<?php

namespace App\Http\Requests\Serving;

use Illuminate\Foundation\Http\FormRequest;

class StoreServingRequest extends FormRequest
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
            //
            "name" => "string|required|max:255",
            "stock_id" => "string|exists:stocks,id|nullable|required_if:supplies_id,null",
            "supplies_id" => "string|exists:supplies,id|nullable|required_if:stock_id,null",
            "description" => "string|nullable",
            "units" => "int|required",
            "unit_type" => "string|required",
        ];
    }
}
