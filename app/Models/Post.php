<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Concerns\Likes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Env;
use Laravel\Scout\Searchable;

class Post extends Model implements Likeable
{
    use HasFactory, HasUuids, Likes, Searchable;

    protected $fillable = [
        'content',
        'attachment_id',
        'author_id'
    ];

    protected $with = [
        'author',
        'likes',
    ];

    public function searchableAs(): string
    {
        return Env::get('APP_ENV') . "_posts_index";
    }

    public function toSearchableArray(): array
    {
        return [
            'content' => $this->content
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function attachment(): BelongsTo
    {
        return $this->belongsTo(Attachment::class);
    }

    public function isLikedBy(string $id): bool
    {
        return $this->likes->contains('user_id', $id);
    }

    public function scopeFavourites(Builder $query, string $id): Builder
    {
        return $query
            ->join('likes', 'posts.id', '=', 'likes.likeable_id')
            ->where('likes.likeable_type', Post::class)
            ->where('likes.user_id', $id)
            ->select('posts.*')
            ->orderBy('likes.created_at', 'desc');
    }
}
