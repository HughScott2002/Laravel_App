<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->state([
            'name' => 'Mary Jane Parker',
            'email' => 'maryJane@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password', [
                'rounds' => 12,
            ]),
            'remember_token' => Str::random(10),
        ])->count(1)->create();

        User::factory()->count(20)->create();
        // dd(get_class($jane), get_class($users));

    }
}
