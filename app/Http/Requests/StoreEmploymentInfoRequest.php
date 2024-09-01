<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmploymentInfoRequest extends FormRequest
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
            'user_id' => ['required', 'exists:users,id'],
            'employee_id' => ['required', 'string', 'max:255'],
            'employment_status_id' => ['required', 'exists:employment_statuses,id'],
            'employment_type_id' => ['required', 'exists:employment_types,id'],
            'department_id' => ['required', 'exists:departments,id'],
            'designation_id' => ['required', 'exists:designations,id'],
            'date_of_employment' => ['required', 'date', 'before_or_equal:' . now()->format('d-m-Y')],
            'date_of_last_promotion' => ['nullable', 'date', 'before_or_equal:' . now()->format('d-m-Y')],
        ];
    }
}
