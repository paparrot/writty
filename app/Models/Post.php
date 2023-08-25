<?php

namespace App\Models;

use App\Contracts\Likeable;
use App\Models\Concerns\Likes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
    ];

    public function searchableAs(): string
    {
        return Env::get('APP_ENV') . "_posts_index";
    }

    public function toSearchableArray(): array
    {
        return [
            'authorName' => $this->author->name,
            'authorNickname' => $this->author->nickname,
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

    public function scopeIncludeReposts(Builder $query): Builder
    {
        $currentUser = auth()->user();

        return $query->when(
            $currentUser,
            function (Builder $query) use ($currentUser): Builder {
                $repostIds = $currentUser
                    ?->posts()
                    ->whereNotNull('reposted_id')
                    ->pluck('reposted_id')
                    ->all();

                $reposts = Post::whereHas(
                    'reposted',
                    fn(Builder $query): Builder => $query->where('author_id', $currentUser->id)
                )->pluck('id');

                return $query
                    ->whereNotIn('posts.id', $repostIds)
                    ->whereNotIn('posts.id', $reposts);
            }
        );
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

    public function replied(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'replied_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(Post::class, 'replied_id')->latest();
    }

    public function reposted(): BelongsTo
    {
        return $this->belongsTo(Post::class, 'reposted_id');
    }

    public function reposts(): HasMany
    {
        return $this->hasMany(Post::class, 'reposted_id')->latest();
    }
}
