<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Jetstream\Jetstream;

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

        return Redirect::route('home');
    }

    public function edit(Request $request): Response
    {
        return Jetstream::inertia()->render($request, 'Profile/Edit');
    }

    public function show(User $user): Response
    {
        $posts = Post::where('author_id', $user->id)->latest()->paginate(10);

        return Inertia::render('Profile/Show', [
            'posts' => PostResource::collection($posts),
            'user' => UserResource::make($user)
        ]);
    }
}
