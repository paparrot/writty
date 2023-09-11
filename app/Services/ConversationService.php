<?php

namespace App\Services;

use App\DTO\Conversation\MessageData;
use App\Events\MessageSent;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ConversationService
{
    public function searchConversation(User $user): Conversation
    {
        $users = [Auth::id(), $user->id];
        $conversation = Conversation::whereDoesntHave(
            'users',
            fn(Builder $query): Builder => $query->whereNotIn('id', $users)
        )->first();

        if (!$conversation) {
            $conversation = new Conversation();
            $conversation->save();
            $conversation->users()->attach($user->id);
            $conversation->users()->attach(Auth::id());
        }

        return $conversation;
    }

    public function createMessage(Conversation $conversation, MessageData $message): Message
    {
        $message = $conversation->messages()->create([
            'message' => $message->message,
            'author_id' => Auth::id()
        ]);

        broadcast(new MessageSent($message));

        return $message;
    }
}
