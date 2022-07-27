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
            'content' => $this->faker->realText($maxNbChars = 900, $indexSize = 2),
            'created_at' => $this->faker->dateTimeBetween('-3 years'),

        ];
    }
}
// $factory->state(BlogPost::class, 'new title', function())
