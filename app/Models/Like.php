<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class Like extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'user_id',
        'post_id',
        'likeable_id',
        'likeable_type'
    ];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class)->withDefault();
    }
}
