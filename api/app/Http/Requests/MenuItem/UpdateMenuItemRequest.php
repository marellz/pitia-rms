<?php

namespace App\Http\Requests\MenuItem;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuItemRequest extends FormRequest
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
            'name' => ['required','string'],
            'menu_item_category_id' => 'nullable|string|exists:menu_item_categories,id',
            'price' => 'integer|nullable',
            'sale_price' => 'nullable|integer',
            'image' => 'nullable|string',
            'description' => 'nullable|string',
        ];
    }
}
