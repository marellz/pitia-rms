<?php

namespace App\Http\Requests\Sale;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class StoreSalesRequest extends FormRequest
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
            'created_by' => ['required',"exists:users,id"], // todo: add admin
            'complete' => 'boolean:false',
            'amount' => 'int|required',
            'status' => 'string|required'
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'created_by' => User::first()->id,
            'complete' => false,
            'status' => 'pending'
        ]);
    }
}
