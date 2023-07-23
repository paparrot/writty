<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class UserProfileController extends Controller
{
    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();

        $user->update($request->safe()->all());

        return Redirect::to(route('home'));
    }
}
