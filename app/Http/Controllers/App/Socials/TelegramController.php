<?php

namespace App\Http\Controllers\App\Socials;

use App\DTO\Auth\UserRegisterData;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class TelegramController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    public function callback(): RedirectResponse
    {
        $socialiteUser = Socialite::driver('telegram')->user();
        $userData = UserRegisterData::fromSocialiteUser($socialiteUser, "telegram");

        $existedUser = User::where('oauth_id', $socialiteUser)
            ->where('oauth_type', 'telegram')
            ->first();

        if ($existedUser) {
            Auth::login($existedUser);

            return to_route('home');
        }

        $user = $this->authService->createUser($userData);

        Auth::login($user);

        return to_route('home');
    }
}
