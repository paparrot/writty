<?php

namespace App\Http\Controllers\API;

use App\DTO\Conversation\MessageData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Conversation\MessageRequest;
use App\Http\Resources\Conversation\ConversationResource;
use App\Http\Resources\Conversation\MessageAuthorResource;
use App\Http\Resources\Conversation\MessageResource;
use App\Models\Conversation;
use App\Models\User;
use App\Services\ConversationService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class ConversationController extends Controller
{
    public function __construct(
        private readonly ConversationService $conversationService
    )
    {
    }

    public function list(): JsonResponse
    {
        $conversations = Conversation::with(['messages' => fn($query) => $query->latest()->limit(1)])
            ->whereHas('messages')
            ->whereHas('users', fn(Builder $query): Builder => $query->where('id', auth()->id()))
            ->get();

        return response()->json([
            'conversations' => ConversationResource::collection($conversations)
        ]);
    }

    public function search(User $user): JsonResponse
    {
        $conversation = $this->conversationService->searchConversation($user);

        return response()->json([
            'conversation' => $conversation->id,
        ]);
    }

    public function show(Conversation $conversation): JsonResponse
    {
        $isConversationUser = $conversation->users->first(fn(User $user) => $user->id === auth()->id());
        if (!$isConversationUser) {
            return response()->json([
                'error' => "Not found."
            ], 404);
        }
        $recipient = $conversation->users->first(fn(User $user): bool => $user->id !== Auth::id());

        return response()->json([
            'id' => $conversation->id,
            'recipient' => MessageAuthorResource::make($recipient),
            'messages' => MessageResource::collection($conversation->messages),
        ]);
    }

    public function store(MessageRequest $request, Conversation $conversation): JsonResponse
    {
        $messageData = MessageData::fromApiRequest($request);
        $message = $this->conversationService->createMessage(conversation: $conversation, message: $messageData);

        return response()->json([
            'message' => MessageResource::make($message)
        ]);
    }
}
