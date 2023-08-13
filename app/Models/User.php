<?php

namespace App\Models;

use App\Contracts\Likeable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasUuids;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

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
        'nickname'
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

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function like(Likeable $likeable)
    {
        if ($this->hasLiked($likeable)) {
            return $this;
        }

        $like = new Like();
        $like->user_id = $this->id;
        $like->likeable()->associate($likeable);
        $like->save();
    }

    public function unlike(Likeable $likeable)
    {
        if (! $this->hasLiked($likeable)) {
            return $this;
        }

        $this->likes()->where('likeable_id', $likeable->id)->delete();
    }

    public function hasLiked(Likeable $likeable)
    {
        if (! $likeable->exists) {
            return false;
        }


        return $likeable->likes()->whereHas('user', fn ($q) => $q->whereId($this->id))->exists();
    }
}
