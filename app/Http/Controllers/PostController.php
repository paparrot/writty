<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\In;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function feed(Request $request): Response
    {
        $postsQuery = Post::with(['author'])->latest();

        if ($request->has('author')) {
            $postsQuery = $postsQuery->whereRelation('author', 'nickname', $request->get('author'));
        }

        return Inertia::render('Feed', [
            'posts' => $postsQuery->get()
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Post/Create');
    }

    public function store(PostRequest $request): RedirectResponse
    {
        Post::create([
            'content' => $request->post('content'),
            'author_id' => $request->user()->id,
        ]);

        return Redirect::to('/');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();

        return Redirect::to('/');
    }
}
