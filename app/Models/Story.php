<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Story extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'media_url',
        'user_id',
    ];

    public function users() : BelongsTo {
        return $this->belongsTo(User::class , "user_id");
    }
}
