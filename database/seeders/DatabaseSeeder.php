<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // \App\Models\User::factory(10)->create();
        // $jane = DB::table('users')->insert([
        //     'name' => 'Mary Jane Parker',
        //     'email' => 'maryJane@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password', [
        //         'rounds' => 12,
        //     ]),
        //     'remember_token' => Str::random(10),
        // ]);
        $jane = User::factory()->state([
            'name' => 'Mary Jane Parker',
            'email' => 'maryJane@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password', [
                'rounds' => 12,
            ]),
            'remember_token' => Str::random(10),
        ])->count(1)->create();

        $else = User::factory()->count(20)->create();
        // dd(get_class($jane), get_class($users));

        $users = $else->concat($jane);
        // dd($users->count(), $jane->count(), $else->count());
        $posts = BlogPost::factory()
            ->count(50)
            ->make()
            ->each(function ($post) use ($users) {
                $post->user_id = $users->random()->id;
                $post->save();
            });

        $comment = Comment::factory()->count(150)->make()
            ->each(function ($comment) use ($posts) {
                $comment->blog_post_id = $posts->random()->id;
                $comment->save();
            });
    }
}
