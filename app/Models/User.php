<?php

namespace App\Models;

use App\Contracts\Likeable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Scout\Searchable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasUuids;
    use HasProfilePhoto;
    use Notifiable;
    use SoftDeletes;
    use TwoFactorAuthenticatable;
    use Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'profile_photo_path',
        'nickname',
        'oauth_id',
        'oauth_type',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function searchableAs(): string
    {
        return "users_index";
    }

    public function toSearchableArray(): array
    {
        return [
            'name' => $this->name,
            'nickname' => $this->nickname,
            'id' => $this->id,
            'email' => $this->email,
        ];
    }

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class, 'author_id');
    }

    public function isFollowing(User $user): bool
    {
        return $user->followers->pluck('id')->contains($this->id);
    }

    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_users', 'user_id', 'follower_id');
    }

    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'users_users', 'follower_id', 'user_id');
    }

    public function follow(User $user): self
    {
        if ($user->followers->where('id', $this->id)->isNotEmpty()) {
            return $this;
        }

        $user->followers()->attach($this->id);

        return $this;
    }

    public function unfollow(User $user): self
    {
        if ($user->followers->where('id', $this->id)->isEmpty()) {
            return $this;
        }

        $user->followers()->detach($this->id);

        return $this;
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function like(Likeable $likeable): self
    {
        if ($this->hasLiked($likeable)) {
            return $this;
        }

        $like = new Like();
        $like->user_id = $this->id;
        $like->likeable()->associate($likeable);
        $like->save();

        return $this;
    }

    public function unlike(Likeable $likeable): self
    {
        if (!$this->hasLiked($likeable)) {
            return $this;
        }

        $likeable->likes()->whereHas('user', fn($q) => $q->whereId($this->id))->delete();

        return $this;
    }

    public function hasLiked(Likeable $likeable): bool
    {
        return $likeable->likes()
            ->whereHas('user', fn($q) => $q->whereId($this->id))
            ->exists();
    }
}
