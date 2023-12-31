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
        $emailChanged = $request->validated('email') !== $user->email;

        if ($request->hasFile('photo')) {
            $profilePhoto = $request->file('photo');
            $photoName = $profilePhoto->getClientOriginalName();
            $photoExtension = $profilePhoto->getClientOriginalExtension();
            Storage::put("images/$photoName.$photoExtension", $profilePhoto->getContent());

            $user->profile_photo_path = Storage::url("images/$photoName.$photoExtension");
            $user->save();
        }

        $user->update($request->validated());

        if ($emailChanged) {
            $user->email_verified_at = null;
            $user->save();
            $user->sendEmailVerificationNotification();

            return to_route('verification.notice');
        }

        return Redirect::route('home');
    }

    public function destroy(): RedirectResponse
    {
        $user = Auth::user();

        $user->posts()->delete();
        $user->delete();

        Auth::logout();

        return to_route('home');
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

    public function followers(User $user): Response
    {
        return Inertia::render('Profile/Followers', [
            'user' => UserResource::make($user),
            'followers' => UserResource::collection($user->followers),
            'currentUserFollowers' => auth()->user()?->followers()->pluck('id') ?? [],
            'currentUserFollowing' => auth()->user()?->following()->pluck('id') ?? [],
        ]);
    }

    public function following(User $user): Response
    {
        return Inertia::render('Profile/Following', [
            'user' => UserResource::make($user),
            'following' => UserResource::collection($user->following),
            'currentUserFollowers' => auth()->user()?->followers()->pluck('id') ?? [],
            'currentUserFollowing' => auth()->user()?->following()->pluck('id') ?? [],
        ]);
    }
}
