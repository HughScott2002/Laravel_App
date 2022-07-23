<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;
// use Illuminate\Support\Facades\DB; 


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

        // dd($users->count(), $jane->count(), $else->count());
        $this->call([
            UsersTableSeeder::class,
            BlogPostsTableSeeder::class,
            CommentsTableSeeder::class
        ]);
    }
}
