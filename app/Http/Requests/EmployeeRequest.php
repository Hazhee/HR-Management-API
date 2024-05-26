<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
            'salary' => 'required|numeric',
            'date_of_employment' => 'required|date',
            'manager_id' => 'nullable|exists:employees,id',
            'department_id' => 'required|exists:departments,id',
            'is_founder' => 'nullable|boolean',
        ];
    }
}
