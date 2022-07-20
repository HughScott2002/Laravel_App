<?php

namespace Database\Factories;

use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(8), // Add the title
            'content' => $this->faker->realText($maxNbChars = 200, $indexSize = 2),
        ];
    }
}
// $factory->state(BlogPost::class, 'new title', function())
