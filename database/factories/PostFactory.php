<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * @return string
     */
    public function getModel(): string
    {
        return config('zeus-sky.models.post');
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->word,
            'slug' => $this->faker->slug(2),
            'description' => $this->faker->sentence,
            'content' => $this->faker->sentence,
            'published_at' => now(),
            'post_type' => $this->faker->randomElement(['page', 'post']),
        ];
    }
}
