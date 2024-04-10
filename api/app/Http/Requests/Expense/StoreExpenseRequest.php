<?php

declare(strict_types=1);

namespace App\Http\Requests\Expense;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
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
            "amount" => 'int|required',
            "expense_type_id" => "required|exists:expense_types,id",
            "extra_details" => "string|nullable",
            "created_by" => "required|exists:users,id",
            "settled" => 'boolean|nullable',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'created_by' => User::first()->id,
        ]);
    }
}
