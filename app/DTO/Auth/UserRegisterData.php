<?php

namespace App\DTO\Auth;

use App\Http\Requests\Api\Auth\RegisterRequest;
use Illuminate\Support\Facades\Hash;
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

    public static function fromAppRequest(array $data): self
    {
        return new self(
            nickname: $data['nickname'],
            password: $data['password'],
            name: $data['name'],
            email: $data['email'],
            oauthId: $data['oauth_id'],
            oauthType: $data['oauth_type'],
        );
    }

    public static function fromApiRequest(RegisterRequest $request): self
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

