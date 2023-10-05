<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaraZeus\Sky\SkyPlugin;

class PostFactory extends Factory
{
    public function getModel(): string
    {
        return SkyPlugin::get()->getModel('Post');
    }

    /**
     * Define the model's default state.
     */
    public function definition(): array
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
