<?php

namespace App\DTO\Auth;

use App\Http\Requests\Api\Auth\LoginRequest as ApiLoginRequest;

class UserLoginData
{
    public function __construct(
        public string|null $name = null,
        public string|null $email = null,
        public string|null $password = null,
        public string|null $oauthId = null,
        public string|null $oauthType = null,
        public string|null $deviceName = null,
    )
    {
    }

    /** TODO: Replace CreateNewUser action with auth service method */
    public static function fromAppRequest(): self
    {
        return new self();
    }

    public static function fromApiRequest(ApiLoginRequest $request): self
    {
        return new self(
            email: $request->validated('email'),
            password: $request->validated('password'),
            deviceName: $request->validated('device_name')
        );
    }
}
