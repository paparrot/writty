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
        return [
            'id' => $this->id,
            'author' => UserResource::make($this->author),
            'content' => $this->content,
            'isLiked' => $this->isLikedBy($request->user()->id),
            'created' => $this->created_at->diffForHumans()
        ];
    }
}
