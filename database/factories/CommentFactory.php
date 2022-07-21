<?php

namespace Database\Factories;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    // private $count = 0;
    public function definition()
    {
        return [
            //
            // 'id'=> $this->faker->text(),
            'content' => $this->faker->realText(),
            // 'created_at '=> $this->faker->text(),
            // 'updated_at'=> $this->faker->text(),
            // 'blog_post_id'=> $this->faker->text(),

        ];
    }
}
