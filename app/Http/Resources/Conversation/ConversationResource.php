<?php

namespace App\Http\Resources\Conversation;

use App\Models\Conversation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var Conversation $this */
        $lastMessage = $this->messages->first();
        $recipient = $this->users->first(fn(User $user) => $user->id !== auth()->id());
        return [
            'message' => MessageResource::make($lastMessage),
            'recipient' => MessageAuthorResource::make($recipient),
            'id' => $this->id,
        ];
    }
}
