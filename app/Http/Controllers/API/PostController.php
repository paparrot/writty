<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    public function list(): JsonResponse
    {
        $posts = Post::includeReposts()
            ->latest()
            ->doesntHave('replied')
            ->paginate();

        return response()->json([
            'posts' => PostResource::collection($posts),
        ]);
    }

    public function show(Post $post): JsonResponse
    {
        return response()->json([
            'post' => PostResource::make($post),
            'replies' => PostResource::collection($post->replies()->paginate())
        ]);
    }
}
