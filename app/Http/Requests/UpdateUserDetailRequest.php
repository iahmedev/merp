<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserDetailRequest extends FormRequest
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
            'phone' => ['required', 'digits:11'],
            'gender' => ['required', 'string', Rule::in(['male', 'female'])],
            'address' => ['required', 'string', 'max:255'],
            'marital_status' => ['required', 'string', Rule::in(['single', 'married', 'widowed'])],
            'state' => ['required', 'string', 'max:255'],
            'lga' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before:' . now()->subYears(18)->format('d-m-Y')],
            'nin' => ['required', 'digits:11'],
        ];
    }
}
