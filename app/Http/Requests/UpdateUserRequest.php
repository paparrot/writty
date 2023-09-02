<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => ['nullable', 'string'],
            'nickname' => [
                'nullable',
                'regex:/^[a-zA-Z0-9]+(?:-[A-Za-z0-9]+)*$/',
                'string',
                Rule::unique('users')->ignore($userId)->whereNull('deleted_at')
            ],
            'email' => [
                'nullable',
                'string',
                'email',
                Rule::unique('users')->ignore($userId)->whereNull('deleted_at')
            ],
            'photo' => ['nullable', 'image']
        ];
    }
}
