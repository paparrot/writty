<?php

namespace App\Http\Controllers\App;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\Conversation\ConversationResource;
use App\Http\Resources\Conversation\MessageAuthorResource;
use App\Http\Resources\Conversation\MessageResource;
use App\Models\Conversation;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class ConversationController extends Controller
{
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

        return to_route('chat.show', ['conversation' => $conversation]);
    }

    public function conversation(Conversation $conversation): RedirectResponse|Response
    {
        $isUserExternal = $conversation->users->first(fn (User $user) => $user->id === auth()->id());
        if (! $isUserExternal) {
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
        $message = $conversation->messages()->create([
            'message' => $request->validated('message'),
            'author_id' => Auth::id()
        ]);

        broadcast(new MessageSent($message));

        return back();
    }
}
