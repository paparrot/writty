<?php

namespace App\Http\Controllers\App;

use App\DTO\Auth\UserRegisterData;
use App\Models\User;
use App\Services\AuthService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;

class SocialsController
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    public function redirect(string $driver)
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function callback(string $driver): RedirectResponse
    {
        try {
            $socialUser = Socialite::driver($driver)->user();
        } catch (Exception $exception) {
            Log::error($exception->getMessage());

            return to_route('login');
        }

        $userData = UserRegisterData::fromSocialiteUser($socialUser, $driver);

        $existedUser = User::where('email', $userData->email)
            ->first();

        if (!$existedUser) {
            $existedUser = User::where('oauth_type', $driver)
                ->where('oauth_id', $userData->oauthId)
                ->first();
        }

        if ($existedUser) {
            Auth::login($existedUser);

            return to_route('home');
        }

        $user = $this->authService->createUser($userData);

        Auth::login($user);

        return to_route('home');
    }
}
