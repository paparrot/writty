<?php

namespace App\Http\Controllers\App;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\Message\MessageAuthorResource;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Post\UserResource;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;
use Inertia\Response;

class ConversationController extends Controller
{

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

    public function conversation(Conversation $conversation): Response
    {
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
