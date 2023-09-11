<?php

namespace App\DTO\Conversation;

use App\Http\Requests\Api\Conversation\MessageRequest as ApiMessageRequest;
use App\Http\Requests\MessageRequest as AppMessageRequest;

class MessageData
{
    public function __construct(
        public string $message
    )
    {
    }

    public static function fromAppRequest(AppMessageRequest $request): self
    {
        return new self($request->validated('message'));
    }

    public static function fromApiRequest(ApiMessageRequest $request): self
    {
        return new self($request->validated('message'));
    }
}
