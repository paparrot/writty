<?php

namespace App\Http\Controllers\App;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Resources\Post\UserResource;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;
use Laravel\Jetstream\Jetstream;

class UserController extends Controller
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

    public function show(Request $request, User $user): Response
    {
        $posts = Post::where('author_id', $user->id)->latest()->paginate(10);

        return Inertia::render('Profile/Show', [
            'posts' => PostResource::collection($posts),
            'user' => UserResource::make($user),
            'isFollowing' => $request->user()?->isFollowing($user) ?? false,
        ]);
    }

    public function verify(): Response
    {
        return Inertia::render('Auth/VerifyEmail');
    }

    public function follow(Request $request, User $user): RedirectResponse
    {
        $request->user()->follow($user);

        return Redirect::back();
    }

    public function unfollow(Request $request, User $user): RedirectResponse
    {
        $request->user()->unfollow($user);

        return Redirect::back();
    }
}