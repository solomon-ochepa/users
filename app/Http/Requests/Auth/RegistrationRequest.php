<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
            "first_name"    => ["required", "string", "max:255"],
            "last_name"     => ["required", "string", "max:255"],
            "username"      => ["required", "string", "string", "min:3", "max:16", "unique:users"],
            "phone"         => ["required", "string", "string", "max:255", "unique:users"],
            "email"         => ["required", "string", "email", "max:255", "unique:users"],
            "password"      => ["required", "string", "min:8"],
            "ref"           => ["required", "string", "min:8"],
        ];
    }
}