<?php

namespace App\Services;

use App\DTO\Auth\UserRegisterData;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthService
{
    public function createUser(UserRegisterData $data): User
    {
        return User::create([
            'name' => $data->name,
            'email' => $data->email,
            'nickname' => $this->createNickname($data->nickname),
            'password' => Hash::make($data->password),
            'oath_id' => $data->oauthId,
            'oauth_type' => $data->oauthType,
            'device_name' => $data->deviceName ?? "web",
            'email_verified_at' => $data->oauthId ? now() : null,
            'profile_photo_path' => $data->avatar
        ]);
    }

    public function generateApiToken(User $user, string $deviceName): string
    {
        return $user->createToken($deviceName)->plainTextToken;
    }

    private function createNickname(string $nickname): string
    {
        $loweredNickname = $nickname = Str::lower($nickname);

        if (!User::whereNickname($loweredNickname)->exists()) {
            return $loweredNickname;
        }

        $newNickname = $nickname . "_" . Str::random(4);

        return $this->createNickname($newNickname);
    }
}
