<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'email' => 'sometimes|required|email|unique:users,email,' . $this->user->id,
            'phone' => 'sometimes|required|string|unique:users,phone,' . $this->user->id,
            'first_name' => 'sometimes|required|string|max:255',
            'last_name' => 'sometimes|required|string|max:255',
            'salary' => 'sometimes|required|numeric|min:0',
            'image' => 'nullable|image',
            'password' => 'nullable|string|min:8|regex:/(?=.*[a-zA-Z])(?=.*[0-9])/',
            'manager_id' => 'nullable|exists:users,id',
            'role' => 'required|in:employee,manager',
            'department_id' => 'required|exists:departments,id',
        ];
    }

    public function messages()
    {
        return [
            'password.regex' => 'The password must contain at least one letter and one number.',
        ];
    }
}
