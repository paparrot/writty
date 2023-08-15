<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Http\Requests\PostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function feed(Request $request): Response
    {
        $postsQuery = Post::latest();

        return Inertia::render('Feed', [
            'posts' => PostResource::collection($postsQuery->paginate(20)),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Post/Create');
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $post = Post::create([
            'content' => $request->post('content'),
            'author_id' => $request->user()->id,
        ]);

        $post->load('author');
        PostCreated::broadcast($post);

        return Redirect::route('home');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $id = $post->id;
        $post->delete();

        PostDeleted::broadcast($id);
        return Redirect::route('home');
    }

    public function favourites(): Response
    {
        $favouritesPost = Post::favourites(auth()->id())->paginate();

        return Inertia::render('Post/Favourites', [
            'posts' => PostResource::collection($favouritesPost)
        ]);
    }

    public function following(Request $request): Response
    {
        $followingIds = $request->user()->following()->pluck('id');
        $posts = Post::whereHas('author', fn ($query) => $query->whereIn('id', $followingIds))->paginate();

        return Inertia::render('Feed', [
            'posts' => PostResource::collection($posts),
        ]);
    }

    public function like(Post $post): RedirectResponse
    {
        auth()->user()->like($post);

        return back();
    }

    public function unlike(Post $post): RedirectResponse
    {
        auth()->user()->unlike($post);

        return back();
    }
}
