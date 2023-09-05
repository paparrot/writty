<?php

namespace App\Http\Resources\Message;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageAuthorResource extends JsonResource
{
    public static $wrap = null;

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /** @var $this User */
        return [
            'id' => $this->id,
            'nickname' => $this->nickname,
            'avatar' => $this->profile_photo_path,
        ];
    }
}
