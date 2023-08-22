<?php

namespace App\Http\Controllers;

use App\Events\PostCreated;
use App\Events\PostDeleted;
use App\Http\Requests\PostRequest;
use App\Http\Resources\Post\PostResource;
use App\Models\Attachment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class PostController extends Controller
{
    public function feed(Request $request): Response
    {

        $posts = Post::includeReposts()
            ->latest()
            ->doesntHave('replied')
            ->paginate();

        return Inertia::render('Feed', [
            'posts' => PostResource::collection($posts),
        ]);
    }

    public function create(): Response
    {
        return Inertia::render('Post/Create');
    }

    public function store(PostRequest $request): RedirectResponse
    {
        $post = Post::create([
            'content' => $request->validated('content'),
            'author_id' => $request->user()->id,
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->getClientOriginalName();

            Storage::put($path, $file->getContent());

            $attachment = Attachment::create([
                'path' => Storage::url($path),
            ]);

            $post->attachment()->associate($attachment);
            $post->save();
        }

        $post->load('author');
        PostCreated::broadcast($post);

        return Redirect::route('home');
    }

    public function show(Post $post): Response
    {
        return Inertia::render('Post/Show', [
            'post' => PostResource::make($post),
            'replies' => PostResource::collection($post->replies()->paginate())
        ]);
    }

    public function destroy(Post $post): RedirectResponse
    {
        $id = $post->id;
        $post->delete();

        PostDeleted::broadcast($id);
        return Redirect::back();
    }

    public function favourites(): Response
    {
        $favouritesPost = Post::includeReposts()->favourites(auth()->id())->paginate();

        return Inertia::render('Post/Favourites', [
            'posts' => PostResource::collection($favouritesPost)
        ]);
    }

    public function following(Request $request): Response
    {
        $followingIds = $request->user()->following()->pluck('id');
        $posts = Post::includeReposts()
            ->whereHas('author', fn($query) => $query->whereIn('id', $followingIds))
            ->latest()
            ->paginate();

        return Inertia::render('Feed', [
            'posts' => PostResource::collection($posts),
        ]);
    }

    public function search(Request $request): Response
    {
        $q = $request->get('q') ?? "";

        $posts = Post::search($q)->get()->take(10);

        return Inertia::render('Post/Search', [
            'posts' => PostResource::collection($posts)
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

    public function reply(Post $post, PostRequest $request): RedirectResponse
    {
        $reply = $post->replies()->create([
            'content' => $request->validated('content'),
            'author_id' => $request->user()->id,
        ]);

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->getClientOriginalName();

            Storage::put($path, $file->getContent());

            $attachment = Attachment::create([
                'path' => Storage::url($path),
            ]);

            $reply->attachment()->associate($attachment);
            $reply->save();
        }

        return Redirect::route('posts.show', ['post' => $post->id]);
    }

    public function createReply(Post $post): Response
    {
        return Inertia::render('Reply/Create', [
            'post' => PostResource::make($post),
        ]);
    }

    public function repost(Post $post, Request $request): RedirectResponse
    {
        if ($post->reposted) {
            $repost = Post::create(['author_id' => $request->user()->id()]);
            $repost->reposted()->associate($post->reposted);
            $repost->save();
            PostCreated::broadcast($repost);

            return back();
        }

        $repost = Post::create(['author_id' => $request->user()->id]);
        $repost->reposted()->associate($post);
        $repost->save();
        PostCreated::broadcast($repost);

        return back();
    }
}
