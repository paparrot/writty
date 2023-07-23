<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class UserProfileController extends Controller
{
    public function update(UpdateUserRequest $request)
    {
        $user = Auth::user();

        $profilePhoto = $request->file('photo');
        $photoName = $profilePhoto->getClientOriginalName();
        $photoExtension = $profilePhoto->getClientOriginalExtension();
        Storage::put("images/$photoName.$photoExtension", $profilePhoto->getContent());

        $user->update([
            'email' => $request->post('email'),
            'name' => $request->post('name'),
            'profile_photo_path' => Storage::url("images/$photoName.$photoExtension"),
        ]);

        return Redirect::to(route('home'));
    }
}
