<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $isLiked = $request->user()?->id ? $this->isLikedBy($request->user()->id) : false;

        return [
            'id' => $this->id,
            'author' => UserResource::make($this->author),
            'content' => $this->content,
            'isLiked' => $isLiked,
            'created' => $this->created_at->diffForHumans()
        ];
    }
}
