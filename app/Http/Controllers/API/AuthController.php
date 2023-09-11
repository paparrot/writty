<?php

namespace App\Http\Controllers\API;

use App\DTO\Auth\UserLoginData;
use App\DTO\Auth\UserRegisterData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Models\User;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $userData = UserLoginData::fromApiRequest($request);
        $user = User::where('email', $userData->email)->first();

        if (!$user || !Hash::check($userData->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        return response()->json([
            'token' => $this->authService->generateApiToken($user, $userData->deviceName),
        ]);
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $userData = UserRegisterData::fromApiRequest($request);
        $user = $this->authService->createUser($userData);

        return response()->json([
            'token' => $this->authService->generateApiToken($user, $userData->deviceName)
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => 'You logged out'
        ]);
    }
}
