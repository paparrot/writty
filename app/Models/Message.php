<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $fillable = [
        'message'
    ];

    public function sender(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_from');
    }

    public function recipient(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_to');
    }
}
