<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'full_name',
        'profile_picture',
        'email',
        'username',
        'password',
        'biography'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function posts(): HasMany {
        return $this->hasMany(Post::class , "user_id");
    }

    public function followers()
    {
        return $this->hasMany(Follower::class, 'follower_id');
    }

    public function following()
    {
        return $this->hasMany(Follower::class, 'user_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class , "user_id");
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class , "user_id");

    }

    public function stories() : hasMany {
        return $this->hasMany(Story::class , "user_id");
    }

}
