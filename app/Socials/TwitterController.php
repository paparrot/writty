<?php

namespace App\Socials;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\RedirectResponse;
use Symfony\Component\HttpFoundation\RedirectResponse as SymfonyRedirectResponse;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class TwitterController extends Controller
{
    public function redirect(): SymfonyRedirectResponse
    {
        return Socialite::driver('twitter-oauth-2')->redirect();
    }

    public function callback(): RedirectResponse
    {
        $twitterUser = Socialite::driver('twitter-oauth-2')->user();

        $existedUser = User::where('oauth_id', $twitterUser->getId())
            ->where('oauth_type', 'twitter')
            ->first();

        if ($existedUser) {
            Auth::login($existedUser);

            return to_route('home');
        }

        $user = User::create([
            'oauth_id' => $twitterUser->getId(),
            'oauth_type' => 'twitter',
            'nickname' => $twitterUser->getNickname(),
            'name' => $twitterUser->getName(),
            'email' => $twitterUser->getEmail(),
            'profile_photo_path' => $twitterUser->getAvatar(),
            'password' => Hash::make($twitterUser->getId()),
            'email_verified_at' => now()
        ]);

        Auth::login($user);

        return to_route('home');
    }
}
