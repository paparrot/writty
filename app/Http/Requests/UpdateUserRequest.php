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
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $userId = $this->route()->parameter('user');

        return [
            'name' => ['required', 'string'],
            'nickname' => ["unique:users,nickname,$userId", 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/', 'required', 'string'],
            'email' => ['required', 'string', 'email', "unique:users,email,$userId"],
            'photo' => ['file', 'image']
        ];
    }
}
