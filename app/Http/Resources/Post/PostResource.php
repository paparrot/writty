<?php

namespace App\Http\Resources\Post;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Post $this */

        $isLiked = $request->user()?->id ? $this->isLikedBy($request->user()->id) : false;
        $this->loadCount('likes', 'replies');

        return [
            'id' => $this->id,
            'author' => UserResource::make($this->author),
            'content' => $this->content,
            'isLiked' => $isLiked,
            'likesCount' => $this->likes_count,
            'repliesCount' => $this->replies_count,
            'created' => $this->created_at->diffForHumans()
        ];
    }
}
