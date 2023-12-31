<?php

namespace App\Events;

use App\Http\Resources\Post\PostResource;
use App\Models\Post;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Env;

class PostCreated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public PostResource $post;

    /**
     * Create a new event instance.
     */
    public function __construct(Post $post)
    {
        $this->post = PostResource::make($post);
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        $env = Env::get("APP_ENV");
        return [
            new Channel("{$env}_feed"),
        ];
    }
}
