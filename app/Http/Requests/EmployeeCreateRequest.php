<?php

namespace App\Http\Requests;

use App\Rules\SubordinationLevels;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeCreateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'photo' => ['nullable', 'image', 'mimes:jpg,png', 'dimensions:min_width=300,min_height=300', 'max:5120'],
            'full_name' => ['required', 'string', 'between:3,256'],
            'phone_number' => ['required', 'regex:/^\+380 \([0-9]{2}\) [0-9]{3} [0-9]{2} [0-9]{2}$/','unique:employees,phone_number'],
            'email' => ['required', 'email', 'unique:employees,email'],
            'position_id' => ['required', 'exists:positions,id'],
            'salary' => ['required', 'decimal:0,3', 'between:0,500'],
            'head' => ['nullable', 'exists:employees,full_name', new SubordinationLevels()],
            'hire_date' => ['required', 'date']
        ];
    }

    public function messages()
    {
        return [
            'position_id.required' => 'The position field is required',
            'position_id.exists' => 'Such position does not exist',
        ];
    }
}
