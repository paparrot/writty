<?php

namespace App\Http\Resources\Message;

use App\Http\Resources\Post\UserResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Crypt;

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
            'sender' => UserResource::make($this->sender),
            'recipient' => UserResource::make($this->recipient),
            'message' => Crypt::decrypt($this->message),
            'time' => $this->created_at->diffForHumans()
        ];
    }
}
