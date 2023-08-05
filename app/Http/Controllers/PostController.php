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
        $postsQuery = Post::with(['author'])->latest();

        if ($request->has('author')) {
            $postsQuery = $postsQuery->whereRelation('author', 'nickname', $request->get('author'));
        }

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
        PostCreated::broadcast($request->user(), $post);

        return Redirect::route('home');
    }

    public function destroy(Post $post): RedirectResponse
    {
        $id = $post->id;
        $post->delete();

        PostDeleted::broadcast($id);
        return Redirect::route('home');
    }
}
