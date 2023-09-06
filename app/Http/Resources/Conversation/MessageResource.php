<?php

namespace App\Http\Resources\Conversation;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    public static $wrap = null;


    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Message $this */
        return [
            'id' => $this->id,
            'message' => $this->message,
            'author' => MessageAuthorResource::make($this->author),
            'time' => $this->created_at->diffForHumans()
        ];
    }
}
