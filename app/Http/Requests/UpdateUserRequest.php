<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = auth()->id();

        return [
            'name' => ['required', 'string'],
            'nickname' => ["unique:users,nickname,$userId", 'regex:/^[a-zA-Z0-9]+(?:-[A-Za-z0-9]+)*$/', 'required', 'string'],
            'email' => ['required', 'string', 'email', "unique:users,email,$userId"],
            'photo' => ['file', 'image']
        ];
    }
}
