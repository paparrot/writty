<?php

namespace App\Socials;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class TelegramController extends Controller
{
    public function callback(): RedirectResponse
    {
        $telegramUser = Socialite::driver('telegram')->user();

        $existedUser = User::where('oauth_id', $telegramUser->getId())
            ->where('oauth_type', 'telegram')
            ->first();

        if ($existedUser) {
            Auth::login($existedUser);

            return to_route('home');
        }

        $user = User::create([
            'oauth_id' => $telegramUser->getId(),
            'oauth_type' => 'telegram',
            'nickname' => $this->getOrGenerateNickname($telegramUser->getNickname()),
            'name' => $telegramUser->getName(),
            'profile_photo_path' => $telegramUser->getAvatar(),
            'password' => Hash::make($telegramUser->getId()),
            'email_verified_at' => now()
        ]);

        Auth::login($user);

        return to_route('home');
    }

    private function getOrGenerateNickname(string $nickname): string
    {
        $nicknameExists = User::where('nickname', $nickname)->exists();

        if (!$nicknameExists) {
            return $nickname;
        }

        return $this->getOrGenerateNickname(Str::random());
    }
}
