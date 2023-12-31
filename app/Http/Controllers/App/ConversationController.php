<?php

namespace App\Http\Controllers\App;

use App\DTO\Conversation\MessageData;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\Conversation\ConversationResource;
use App\Http\Resources\Conversation\MessageAuthorResource;
use App\Http\Resources\Conversation\MessageResource;
use App\Models\Conversation;
use App\Models\User;
use App\Services\ConversationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ConversationController extends Controller
{
    public function __construct(
        private readonly ConversationService $conversationService
    )
    {
    }

    public function list(): Response
    {
        $conversations = Conversation::with(['messages' => fn($query) => $query->latest()->limit(1)])
            ->whereHas('messages')
            ->whereHas('users', fn(Builder $query): Builder => $query->where('id', auth()->id()))
            ->get();

        return Inertia::render('Conversation/List', [
            'conversations' => ConversationResource::collection($conversations)
        ]);
    }

    public function search(User $user): RedirectResponse
    {
        $conversation = $this->conversationService->searchConversation($user);

        return to_route('chat.show', ['conversation' => $conversation]);
    }

    public function conversation(Conversation $conversation): RedirectResponse|Response
    {
        $isConversationUser = $conversation->users->first(fn(User $user) => $user->id === auth()->id());
        if (!$isConversationUser) {
            return to_route('chat.list');
        }

        $recipient = $conversation->users->first(fn(User $user): bool => $user->id !== Auth::id());

        return Inertia::render('Conversation/Show', [
            'conversation' => $conversation->id,
            'recipient' => MessageAuthorResource::make($recipient),
            'messages' => MessageResource::collection($conversation->messages)
        ]);
    }

    public function store(MessageRequest $request, Conversation $conversation): RedirectResponse
    {
        $messageData = MessageData::fromAppRequest($request);
        $this->conversationService->createMessage(conversation: $conversation, message: $messageData);

        return back();
    }
}
