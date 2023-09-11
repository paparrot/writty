<?php

namespace App\Http\Controllers\App;

use App\DTO\Auth\UserRegisterData;
use App\Http\Requests\App\Auth\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController
{
    public function __construct(
        private readonly AuthService $authService,
    )
    {
    }

    public function register(RegisterRequest $request): RedirectResponse
    {
        $data = UserRegisterData::fromAppRequest($request);
        $user = $this->authService->createUser($data);
        $user->sendEmailVerificationNotification();

        Auth::login($user);

        return to_route('verification.notice');
    }
}
