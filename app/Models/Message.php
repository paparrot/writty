<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Staudenmeir\EloquentEagerLimit\HasEagerLimit;

class Message extends Model
{
    use HasFactory, HasUuids, SoftDeletes, HasEagerLimit;

    protected $fillable = [
        'message',
        'author_id'
    ];

    public function conversation(): BelongsTo
    {
        return $this->belongsTo(Conversation::class, 'conversation_id','id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
