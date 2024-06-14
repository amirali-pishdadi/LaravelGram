<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    use HasFactory;

    protected $primaryKey = 'post_id'; // it is important 
    public function users(): BelongsTo
    {
        return $this->belongsTo(User::class, "user_id");
    }

    public function medias(): HasMany
    {
        return $this->hasMany(Media::class, "post_id");
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, "post_id", "post_id");
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, "post_id", "post_id");
    }

    protected $fillable = [
        'description',
        'location',
        "user_id",
        'path',
    ];
}
