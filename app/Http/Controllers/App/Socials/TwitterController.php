<?php

namespace App\Http\Controllers\App\Socials;

use App\DTO\Auth\UserRegisterData;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\AuthService;
use Auth;
use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;

class TwitterController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    public function redirect(): SymfonyRedirectResponse
    {
        return Socialite::driver('twitter')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $twitterUser = Socialite::driver('twitter')->user();
        $userData = UserRegisterData::fromSocialiteUser($twitterUser, 'twitter');

        $existedUser = User::where('oauth_id', $twitterUser->getId())
            ->where('oauth_type', 'twitter')
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
