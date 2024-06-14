<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Comment;
use App\Models\Follower;
use App\Models\Like;
use App\Models\Media;
use App\Models\Post;
use App\Models\Story;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Post::factory(10)->create();
        Media::factory(10)->create();
        Like::factory(10)->create();
        Story::factory(10)->create();
        Comment::factory(10)->create();
        Follower::factory(10)->create();
    }
}
