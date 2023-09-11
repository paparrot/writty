<?php

namespace App\Http\Requests\App\Auth;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    use PasswordValidationRules;

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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'nickname' => [
                'regex:/^[a-z0-9A-Z]+(?:(-|_)[A-Za-z0-9]+)*$/',
                'required',
                'string',
                Rule::unique('users')->whereNull('deleted_at')
            ],
            'name' => ['string', 'required'],
            'password' => $this->passwordRules(),
        ];
    }
}
