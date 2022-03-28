<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use LaraZeus\Sky\Models\Post;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => $this->faker->title,
            'slug' => $this->faker->slug(2),
            'parent_id' => 0,
            'description' => $this->faker->sentence,
            'content' => $this->faker->sentence,
            'post_type' => 'page',
        ];
    }
}