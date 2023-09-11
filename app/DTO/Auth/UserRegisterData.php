<?php

namespace App\DTO\Auth;

use App\Http\Requests\Api\Auth\RegisterRequest as ApiRegisterRequest;
use App\Http\Requests\App\Auth\RegisterRequest as AppRegisterRequest;
use Laravel\Socialite\Contracts\User;

class UserRegisterData
{
    public function __construct(
        public string      $nickname,
        public string      $password,
        public string|null $name = null,
        public string|null $email = null,
        public string|null $oauthId = null,
        public string|null $oauthType = null,
        public string|null $deviceName = null,
        public string|null $avatar = null,
    )
    {
    }

    public static function fromSocialiteUser(User $user, string $driver): self
    {
        return new self(
            nickname: $user->getNickname(),
            password: $user->getId(),
            name: $user->getName(),
            email: $user->getEmail(),
            oauthId: $user->getId(),
            oauthType: $driver,
            avatar: $user->getAvatar()
        );
    }

    public static function fromAppRequest(AppRegisterRequest $request): self
    {
        return new self(
            nickname: $request->validated('nickname'),
            password: $request->validated('password'),
            name: $request->validated('name'),
            email: $request->validated('email'),
        );
    }

    public static function fromApiRequest(ApiRegisterRequest $request): self
    {
        return new self(
            nickname: $request->validated('nickname'),
            password: $request->validated('password'),
            name: $request->validated('name'),
            email: $request->validated('email'),
            deviceName: $request->validated('device_name')
        );
    }
}

