<?php

namespace App\Responses;

use Illuminate\Http\RedirectResponse;
use Laravel\Fortify\Contracts\RegisterResponse as RegisterResponseInterface;

class RegisterResponse implements RegisterResponseInterface
{

    public function toResponse($request): RedirectResponse
    {
        return to_route('verification.notice');
    }
}
