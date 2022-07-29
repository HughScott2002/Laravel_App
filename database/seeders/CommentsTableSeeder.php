<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        $posts = BlogPost::all();
        Comment::factory()->count(500)->make()
            ->each(function ($comment) use ($posts, $users) {
                $comment->blog_post_id = $posts->random()->id;
                $comment->user_id = $users->random()->id;
                $comment->save();
            });
    }
}
