<?php

namespace App\Http\Controllers\App;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Http\Requests\MessageRequest;
use App\Http\Resources\Message\MessageResource;
use App\Http\Resources\Post\UserResource;
use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Inertia\Inertia;
use Inertia\Response;

class MessageController extends Controller
{
    public function chat(User $user): Response
    {
        $messages = Message::where(fn(Builder $builder): Builder => $builder
            ->where('user_from', auth()->id())
            ->where('user_to', $user->id)
        )->orWhere(fn(Builder $builder): Builder => $builder
            ->where('user_to', auth()->id())
            ->where('user_from', $user->id)
        )->oldest()->get();

        return Inertia::render('Chat', [
            'user' => UserResource::make($user),
            'messages' => MessageResource::collection($messages)
        ]);
    }

    public function store(MessageRequest $request): RedirectResponse
    {
        $textMessage = $request->validated('message');
        $message = new Message();
        $message->message = Crypt::encrypt($textMessage);
        $message->user_from = auth()->id();
        $message->user_to = $request->validated('recipient_id');
        $message->save();

        broadcast(new MessageSent($message));

        return back();
    }
}
